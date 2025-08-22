<?php
declare(strict_types=1);

namespace SixShop\Filesystem\Model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 * Class SixShop\Filesystem\Model\FilesystemFileModel
 *
 * @property int $category_id 分类id
 * @property int $file_size 文件大小
 * @property int $id 主键
 * @property string $create_time 创建时间
 * @property string $delete_time 删除时间
 * @property string $file_ext 文件类型
 * @property string $file_hash 文件hash
 * @property string $file_mine 文件MIME
 * @property string $file_name 文件名
 * @property string $file_path 文件路径
 * @property string $file_url 文件URL
 * @property string $name 文件备注名称
 * @property string $update_time 更新时间
 * @method static \think\db\Query onlyTrashed()
 * @method static \think\db\Query withTrashed()
 */
class FilesystemFileModel extends Model
{
    protected $name = 'extension_filesystem_file';
    protected $pk = 'id';

    use SoftDelete;

    public function searchKeywordAttr($query, $value): void
    {
        if ($value) {
            $query->whereLike('file_name|name', '%' . $value . '%');
        }
    }

    public function searchCategoryIdAttr($query, int $value): void
    {
        if ($value >= 0) {
            $query->where('category_id', $value);
        }
    }
}