<?php
declare(strict_types=1);

namespace SixShop\Filesystem\Entity;

use SixShop\Core\Entity\BaseEntity;
use SixShop\Filesystem\Model\FilesystemFileModel;
use think\facade\Event;
use think\facade\Filesystem;
use think\File;
use think\file\UploadedFile;
use think\Paginator;

/**
 * @mixin FilesystemFileModel
 */
class FilesystemFileEntity extends BaseEntity
{
    public function upload(int $categoryId, array|UploadedFile|null $file): FilesystemFileModel
    {
        $relativeDir = $categoryId . '/' . date('Ym') . '/' . date('d');
        $fileHash = $file->hash();
        $fileEntity = $this->withTrashed()->where([
            'file_hash' => $fileHash,
            'category_id' => $categoryId
        ])->findOrEmpty();
        if ($fileEntity->isEmpty()) {
            $fileEntity = $this->withTrashed()->where([
                'file_hash' => $fileHash,
            ])->findOrEmpty();
        }
        if ($fileEntity->isEmpty()) {
            $fileName = date('YmdHis') . '_' . $fileHash;
            $filePath = Filesystem::putfile($relativeDir, $file, fn(File $file) => $fileName);
            $fileExt = $file->extension();
            $fileName .= '.' . $fileExt;
            $data = [
                'category_id' => $categoryId,
                'file_hash' => $fileHash,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_size' => $file->getSize(),
                'file_ext' => $fileExt,
                'file_mine' => $file->getMime(),
                'file_url' => Filesystem::url($filePath),
            ];
        } else {
            $data = $fileEntity->toArray();
            // 删除相同文件
            /*$this->destroy([
                'category_id' => $categoryId,
                'file_hash' => $fileHash
            ]);*/
            $data['category_id'] = $categoryId;
            unset($data['id'], $data['name'], $data['create_time'], $data['update_time'], $data['delete_time']);
        }
        $result = $this->create($data);
        Event::trigger('after_filesystem_upload', $result->id);
        return $result;
    }

    public function getPage(array $params, array $page): Paginator
    {
        return $this->withSearch(['category_id', 'keyword'], $params)
            ->order('id', 'desc')
            ->paginate($page);
    }
}