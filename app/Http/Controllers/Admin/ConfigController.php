<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ConfigRequest;
use App\Models\Config;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ConfigController extends BaseController
{
    /**
     * 首页
     *
     * @return View
     */
    public function index()
    {
        $codes = array_column(Config::CONFIG, 'code');
        $configs = Config::whereIn('code', $codes)->get(['code', 'value'])->keyBy('code');

        $settings = Config::CONFIG;
        foreach ($settings as &$setting) {
            $code = $setting['code'];
            $config = !empty($configs[$code]) ? json_decode($configs[$code]->value, true) : [];
            foreach ($setting['column'] as &$item) {
                $item['value'] = $config[$item['column']] ?? '';
            }
        }

        return view('admin.config', ['configs' => $settings]);
    }

    /**
     * 保存
     *
     * @param ConfigRequest $request
     * @return JsonResponse
     */
    public function update(ConfigRequest $request)
    {
        $code = $request->input('_config_code');

        $config = constant('App\Models\Config::' . strtoupper($code));
        $columns = array_column($config['column'], 'column');
        $new = $request->only($columns);

        $config = Config::where('code', $code)->first();
        if ($config) {
            $config->update(['value' => json_encode($new)]);
        } else {
            Config::create(['value' => json_encode($new), 'code' => $code]);
        }

        return $this->responseSuccess('保存成功');
    }
}