<?php

namespace App\Models;

use App\Rules\EachRequired;
use App\Rules\TreeRequired;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * @var array 状态
     */
    const STATUS = [
        1 => '启用',
        2 => '禁用',
    ];

    /**
     * @var array 输入类型
     */
    const INPUT = [
        'integer' => '整数',
        'number' => '数值',
        'string' => '单行文本',
        'text' => '多行文本',
        'email' => '邮箱',
        'mobile' => '手机号',
        'tel' => '电话号码',
        'html' => 'HTML',
        'markdown' => 'Markdown',
        'file' => '文件',
        'media' => '视频',
        'image' => '图片',
        'images' => '多图',
        'radio' => '单选',
        'checkbox' => '多选',
        'date' => '日期',
        'datetime' => '日期时间',
        'json' => 'json',
        'ip' => 'ip',
        'id_card' => '身份证',
        'tags' => '标签',
        'tree' => '级联',
        'area' => '省市区',
        'location' => '经纬度',
        'attribute' => '自定义属性',
        'specification' => '自定义规格',
    ];

    /**
     * @var array 输入类型的验证规则
     */
    const RULES = [
        'integer' => ['integer'],
        'number' => ['numeric'],
        'email' => ['email'],
        'mobile' => ['regex:/^1\d{10}$/'],
        'tel' => ['regex:(^1\d{10}$)|(^(0\d{2,3}\-)?\d{7,8}$)'],
        'json' => ['json'],
        'ip' => ['ip'],
        'id_card' => ['regex:/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/'],
        'images' => ['array'],
        'date' => ['date'],
        'datetime' => ['date_format:Y-m-d H:i:s'],
        'tree' => ['array'],
        'area' => ['array'],
        'location' => ['regex:/^\d[.,\d]*\d$/'],
        'attribute' => ['array'],
        'specification' => ['array'],
    ];

    /**
     * 获取验证规则
     *
     * @param $input
     * @param array $default
     * @return array
     */
    public static function getInputRules($input, $default = [])
    {
        if (in_array($input, ['attribute', 'specification'])) {
            $default[] = new EachRequired;
        }
        if ($input == 'tree' && in_array('required', $default)) {
            $default[] = new TreeRequired;
        }
        $rules = [];
        if (!empty($default)) {
            $default = is_array($default) ? $default : [$default];
            $rules = $default;
        }
        if (!empty(self::RULES[$input])) {
            $rules = array_merge($rules, self::RULES[$input]);
        }
        return $rules;
    }

    /**
     * 根据input解码content_attributes表的value
     *
     * @param $value
     * @param $input
     * @return mixed
     */
    public static function decodeContentValue($value, $input)
    {
        switch ($input) {
            case 'images':
            case 'checkbox':
            case 'attribute':
            case 'specification':
                $newValue = empty($value) ? [] : json_decode($value, true);
                break;
            case 'tree':
                $newValue = Tree::withTrashed()->find($value);
                if ($newValue) {
                    $path = $newValue->path ? explode(',', $newValue->path) : [];
                    $path[] = $newValue->id;
                    $newValue->path = $path;
                }
                break;
            case 'area':
                $newValue = Area::withTrashed()->find($value);
                if ($newValue) {
                    $path = $newValue->path ? explode(',', $newValue->path) : [];
                    $path[] = $newValue->id;
                    $newValue->path = $path;
                }
                break;
            default:
                $newValue = $value;
        }
        return $newValue;
    }

    /**
     * 获取ID
     *
     * @param $code
     * @return int
     */
    public static function getIdByCode($code)
    {
        $attribute = self::where('code', $code)->first();
        return $attribute ? $attribute->id : 0;
    }
}
