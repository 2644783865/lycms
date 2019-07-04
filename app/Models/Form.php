<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Yeosz\LaravelCurd\Traits\TreeTrait;

class Form extends Model
{
    use SoftDeletes, TreeTrait;

    protected $guarded = ['id'];

    /**
     * 属性
     *
     * @return Collection
     */
    public function getAttributesAttribute()
    {
        $fields = [
            'form_attributes.id',
            'form_attributes.form_id',
            'form_attributes.sort',
            'form_attributes.required',
            'form_attributes.show',
            'form_attributes.attribute_id',
            'attributes.code as attribute_code',
            'attributes.name as attribute_name',
            'attributes.status as attribute_status',
        ];
        $attributes = FormAttribute::leftJoin('attributes', 'attributes.id', '=', 'form_attributes.attribute_id')
            ->where('form_attributes.form_id', $this->id)
            ->orderBy('form_attributes.sort', 'asc')
            ->get($fields);

        return $attributes;
    }

    /**
     * 详细属性
     *
     * @return Collection
     */
    public function getAttrDetailsAttribute()
    {
        $fields = [
            'attributes.id',
            'attributes.code',
            'attributes.name',
            'attributes.alias_name',
            'attributes.value',
            'attributes.tree_id',
            'attributes.input',
            'attributes.unit',
            'attributes.placeholder',
            'form_attributes.required',
            'form_attributes.show',
        ];

        $attributes = FormAttribute::leftJoin('attributes', 'attributes.id', '=', 'form_attributes.attribute_id')
            ->where('form_attributes.form_id', $this->id)
            ->where('attributes.status', 1)
            ->orderBy('form_attributes.sort', 'asc')
            ->get($fields);

        $getSelect = function ($length) {
            $arr = [];
            for ($i = 0; $i < $length; $i++) {
                $arr[] = 'tree-' . $i;
            }
            return json_encode($arr);
        };
        foreach ($attributes as $attribute) {
            if (in_array($attribute->input, ['radio', 'checkbox'])) {
                $attribute->value = empty($attribute->value) ? [] : explode('|', $attribute->value);
            } elseif ($attribute->input == 'tree') {
                $tree = Tree::withTrashed()->find($attribute->tree_id);
                $tree->level = $tree->level ? explode(',', $tree->level) : [];
                $depth = count($tree->level);
                $tree->select = $getSelect($depth);
                $attribute->value = $tree;
            }
        }

        return $attributes;
    }
}
