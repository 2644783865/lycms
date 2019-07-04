<?php
/**
 * 复制到QQ安装目录下的LocList.xml文件到database目录,然后执行命令
 *
 * Date: 2019-06-25
 * Time: 17:13
 */
namespace App\Console\Commands;

use App\Models\Area as AreaModel;
use Illuminate\Console\Command;

class ImportArea extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lyadmin:import-area';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入行政区域';

    public function handle()
    {
        $file = database_path('LocList.xml');
        if (!file_exists($file)) {
            echo '文件不存在';
            return false;
        }
        $doc = simplexml_load_file($file);

        $country = $doc->CountryRegion;
        $areas = [];
        foreach ($country as $v) {
            $temp = $v->attributes();
            $str = strval($temp['Name']);
            if ($str == '中国') {
                $states = $v->State;
                foreach ($states as $vv) {
                    $temp = $vv->attributes();
                    $state = [
                        'name' => strval($temp['Name']),
                        'code' => strval($temp['Code']),
                    ];
                    $cities = $vv->City;
                    if (!empty($cities)) {
                        foreach ($cities as $vvv) {
                            $temp = $vvv->attributes();
                            $city = [
                                'name' => strval($temp['Name']),
                                'code' => strval($temp['Code']),
                                'children' => [],
                            ];
                            $regions = $vvv->Region;
                            if (!empty($regions)) {
                                foreach ($regions as $vvvv) {
                                    $temp = $vvvv->attributes();
                                    $city['children'][] = [
                                        'name' => strval($temp['Name']),
                                        'code' => strval($temp['Code']),
                                    ];
                                }
                            }
                            $state['children'][] = $city;
                        }
                    }
                    $areas[] = $state;
                }
            }
        };

        foreach ($areas as $v) {
            $province = AreaModel::where('name', $v['name'])->where('depth', 1)->first();
            $new = $this->getNewRow($v, 1);
            if ($province) {
                $province->update($new);
            } else {
                $province = AreaModel::create($new);
            }
            foreach ($v['children'] as $vv) {

                $city = AreaModel::where('name', $vv['name'])->where('depth', 2)->where('parent_id', $province->id)->first();
                $new = $this->getNewRow($vv, 2, $province);
                if ($city) {
                    $city->update($new);
                } else {
                    $city = AreaModel::create($new);
                }
                foreach ($vv['children'] as $vvv) {
                    $district = AreaModel::where('name', $vvv['name'])->where('depth', 3)->where('parent_id', $city->id)->first();
                    $new = $this->getNewRow($vvv, 3, $city);
                    if ($district) {
                        $district->update($new);
                    } else {
                        $district = AreaModel::create($new);
                    }
                }
            }
        }
    }

    public function getNewRow($data, $depth, AreaModel $parent = null)
    {
        $name = str_replace('　', '', $data['name']);
        $name = trim($name);
        $parentName = $parent ? $parent->full_name : '';
        $new = [
            'name' => $name,
            'full_name' => $parentName . $name,
            'code' => $data['code'],
            'parent_id' => $parent ? $parent->id : 0,
            'depth' => $depth,
            'path' => $parent ? trim($parent->path . ',' . $parent->id, ',') : '',
            'status' => 1,
            'deleted_at' => null,
        ];

        return $new;
    }

    public function object2array($object)
    {
        return @json_decode(@json_encode($object), 1);
    }
}