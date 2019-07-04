<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * 菜单栏显示
     */
    const SHOW = [
        1 => '是',
        2 => '否',
    ];

    /**
     * 父级
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(Menu::class, 'id', 'parent_id');
    }
}
