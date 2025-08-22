<?php
declare(strict_types=1);
namespace SixShop\Filesystem\Model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 * Class SixShop\Filesystem\Model\FilesystemCategoryModel
 *
 * @property int $file_count 文件数量
 * @property int $id 主键
 * @property int $level 层级
 * @property int $parent_id 父级ID
 * @property int $sort 排序
 * @property string $create_time 创建时间
 * @property string $delete_time 删除时间
 * @property string $name 名称
 * @property string $update_time 更新时间
 * @method static \think\db\Query onlyTrashed()
 * @method static \think\db\Query withTrashed()
 */
class FilesystemCategoryModel extends Model
{
    protected $name = 'extension_filesystem_category';
    protected $pk = 'id';

    use SoftDelete;
}