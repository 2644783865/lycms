<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Ad
 *
 * @property int $id
 * @property int $position_id 广告位ID
 * @property string $title 标题
 * @property string $subtitle
 * @property string $image 广告图
 * @property int $sort 排序
 * @property int $status 状态：1启用,2禁用
 * @property int $target_type 链接类型
 * @property string|null $target 链接内容
 * @property string|null $start_time 开始时间
 * @property string|null $end_time 结束时间
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereTargetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ad withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Ad withoutTrashed()
 */
	class Ad extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin withoutTrashed()
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AdPosition
 *
 * @property int $id
 * @property string $name 品牌名称
 * @property int $status 状态:1启用,2禁用
 * @property string $remark 说明
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AdPosition onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdPosition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AdPosition withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AdPosition withoutTrashed()
 */
	class AdPosition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Area
 *
 * @property int $id
 * @property int $parent_id 父ID
 * @property string $name 名称
 * @property string $code code
 * @property string $full_name 全称
 * @property int $depth 深度
 * @property int $status 状态
 * @property string $path 路径
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Area withoutTrashed()
 */
	class Area extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property string $code 编码
 * @property string $name 名称
 * @property string $alias_name 别名
 * @property string|null $value 备选值
 * @property int|null $tree_id
 * @property int $status 状态
 * @property string $input 类型
 * @property string $unit 单位
 * @property string $placeholder 提示文字
 * @property string $remark 备注
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Attribute onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereAliasName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereInput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute wherePlaceholder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereTreeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Attribute withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Attribute withoutTrashed()
 */
	class Attribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Config
 *
 * @property int $id
 * @property string $code CODE
 * @property string|null $value 值
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereValue($value)
 */
	class Config extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Content
 *
 * @property int $id
 * @property int $form_id 表单ID
 * @property string $title 标题
 * @property string $cover
 * @property int $status 状态:1启用2禁用
 * @property int $top
 * @property int $page_view 浏览量
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContentAttribute[] $contentAttribute
 * @property-read \App\Models\Form $form
 * @property-read array $attr_map
 * @property-read \Collection $attributes
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Content onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content wherePageView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Content withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Content withoutTrashed()
 */
	class Content extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContentAttribute
 *
 * @property int $content_id 内容id
 * @property int $attribute_id 属性id
 * @property string|null $attribute_value 属性值
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentAttribute whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentAttribute whereAttributeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentAttribute whereContentId($value)
 */
	class ContentAttribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Form
 *
 * @property int $id
 * @property string $code 编码
 * @property string $name 名称
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Collection $attr_details
 * @property-read \Collection $attributes
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Form onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Form withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Form withoutTrashed()
 */
	class Form extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FormAttribute
 *
 * @property int $id
 * @property int $form_id 模型id
 * @property int $attribute_id 属性id
 * @property int $sort 排序
 * @property int $required 必填
 * @property int $show 列表显示
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormAttribute onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute whereShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormAttribute whereSort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormAttribute withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormAttribute withoutTrashed()
 */
	class FormAttribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int $parent_id 父ID
 * @property string $name 菜单名称
 * @property string $link 链接地址
 * @property string $controller 控制器
 * @property string $action action
 * @property string $icon icon
 * @property int $show 显示：1显示2不显示
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Menu $parent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereController($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu withoutTrashed()
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tree
 *
 * @property int $id
 * @property int $root_id 根ID
 * @property int $parent_id 父ID
 * @property string $name 名称
 * @property int $sort 排序
 * @property int $depth 深度
 * @property int $status 状态
 * @property string $path 路径
 * @property string $level 级别
 * @property string $remark 备注
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Tree $parent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tree onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereRootId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tree whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tree withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tree withoutTrashed()
 */
	class Tree extends \Eloquent {}
}

