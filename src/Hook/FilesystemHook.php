<?php
declare(strict_types=1);

namespace SixShop\Filesystem\Hook;

use SixShop\Core\Attribute\Hook;
use SixShop\Core\Helper;
use SixShop\Filesystem\Model\FilesystemCategoryModel;
use SixShop\Filesystem\Model\FilesystemFileModel;
use think\App;
use think\exception\ErrorException;

class FilesystemHook
{
    private bool $configInit = false;

    /**
     * 检查数据库里面是否存在数据
     */
    #[Hook("before_uninstall_filesystem_extension")]
    public function checkDatabase(): void
    {
        FilesystemCategoryModel::withTrashed()->count() > 0 && abort(500, '请先删除分类数据');
        FilesystemFileModel::withTrashed()->count() > 0 && abort(500, '请先删除文件数据');
    }

    #[Hook(["after_filesystem_upload", "after_filesystem_delete"])]
    public function updateCategoryFileCount(int $id): void
    {
        $file = FilesystemFileModel::withTrashed()->find($id);
        $count = FilesystemFileModel::where('category_id', $file->category_id)->count();
        FilesystemCategoryModel::where('id', $file->category_id)->update([
            'file_count' => $count
        ]);
    }

    #[Hook("hook_init")]
    public function init(App $app): void
    {
        $app->config->hook(function ($name, $value) use ($app) {
            if (str_starts_with($name, 'filesystem') && !$this->configInit) {
                $config = extension_config('filesystem');
                try {
                    $app->config->set([
                        // 默认磁盘
                        'default' => $config['driver'],
                        // 磁盘列表
                        'disks' => [
                            $config['driver'] => [
                                'type' => $config['driver'],
                                'root' => app()->getRootPath() . $config['root'],
                                'url' => $config['url'],
                                'visibility' => 'public',
                            ],
                        ]
                    ], 'filesystem');
                    $this->configInit = true;
                } catch (ErrorException $e) {
                    Helper::throw_logic_exception('filesystem配置错误');
                }
                return $app->config->get($name);
            }
            return $value;
        }, 'filesystem');
    }
}