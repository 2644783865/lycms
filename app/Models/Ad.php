<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use SoftDeletes;

    /**
     * @var array 状态
     */
    const STATUS = [
        1 => '启用',
        2 => '禁用',
    ];

    /**
     * @var array 目标类型
     */
    const TARGET_TYPE = [
        1 => '网页链接',
    ];

    protected $guarded = ['id'];
    
    public static function getAdsByPositionId($positionId)
    {
        $now = date('Y-m-d H:i:s');
        $ads = self::where('status', 1)
            ->where('position_id', $positionId)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>', $now)
            ->get();

        return $ads;
    }
}
