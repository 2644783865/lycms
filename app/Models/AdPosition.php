<?php

namespace App\Models;

use Faker\Test\Provider\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdPosition extends Model
{
    use SoftDeletes;

    /**
     * 状态
     */
    const STATUS = [
        1 => '启用',
        2 => '禁用',
    ];

    protected $guarded = ['id'];

    /**
     * 选项
     *
     * @return Collection
     */
    public static function options()
    {
        return self::where('status', 1)->get(['id', 'name', 'remark']);
    }
}
