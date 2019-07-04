<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tree extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * 菜单栏显示
     */
    const STATUS = [
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
        return $this->hasOne(Tree::class, 'id', 'parent_id');
    }

    /**
     * 获取选项
     *
     * @param array $ids
     * @return mixed
     */
    public static function rootOptions($ids = [])
    {
        if (!empty($ids) && !is_array($ids)) {
            $ids = [$ids];
        }
        $options = Tree::withTrashed()->where('root_id', 0)
            ->where(function (Builder $query) use ($ids) {
                $query->whereNull('deleted_at');
                if ($ids) $query->orWhereIn('id', $ids);
            })->get(['id', 'name'])
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->name];
            })->toArray();
        return $options;
    }

    /**
     * 输出树形select
     *
     * @param $tree
     * @param $selected
     * @param int $disableDepth
     * @param string $primaryKey
     */
    public static function treeOptions($tree, $selected, $disableDepth = 0, $primaryKey = 'id')
    {
        $selected = is_numeric($selected) ? $selected : $selected->$primaryKey;
        $optionStr = [];
        foreach ($tree as $item) {
            $depth = $item['tree_depth'];
            $depthStr = $depth ? str_repeat("&nbsp; &nbsp;", $depth) : '';
            $selectedStr = $item[$primaryKey] == $selected ? 'selected="selected"' : '';
            $disableStr = ($depth < $disableDepth && !$selectedStr) ? 'disabled="disabled"' : '';
            $optionStr[] = "<option value='{$item['id']}' {$disableStr} {$selectedStr}>{$depthStr} {$item['name']}</option>";
        }
        $optionStr = implode('', $optionStr);
        echo $optionStr;
    }
}
