<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Content extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * 状态
     */
    const STATUS = [
        1 => '启用',
        2 => '禁用',
    ];

    /**
     * 属性
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentAttribute()
    {
        return $this->hasMany(ContentAttribute::class, 'content_id', 'id');
    }

    /**
     * 表单
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function form()
    {
        return $this->hasOne(Form::class, 'id', 'form_id');
    }

    /**
     * 属性
     *
     * @return Collection
     */
    public function getAttributesAttribute()
    {
        return $this->getContentAttributesById($this->id);
    }

    /**
     * 属性字典
     *
     * @return array
     */
    public function getAttrMapAttribute()
    {
        $attributes = $this->getContentAttributesById($this->id);
        $dict = $attributes->mapWithKeys(function ($item) {
            return [$item['attribute_code'] => $item['attribute_value']];
        });
        return $dict;
    }

    /**
     *
     *
     * @param $ids
     * @return Collection
     */
    public function getContentAttributesById($ids)
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }
        $fields = [
            'content_attributes.content_id',
            'content_attributes.attribute_id',
            'content_attributes.attribute_value',
            'attributes.code as attribute_code',
            'attributes.input as attribute_input',
            'attributes.name as attribute_name'
        ];
        $attributes = ContentAttribute::leftJoin('attributes', 'attributes.id', '=', 'content_attributes.attribute_id')
            ->whereIn('content_attributes.content_id', $ids)
            ->get($fields);

        foreach ($attributes as &$attribute) {
            $attribute->attribute_value = Attribute::decodeContentValue($attribute->attribute_value, $attribute->attribute_input);
        }

        return $attributes;
    }
}
