<?php
declare(strict_types=1);

namespace SixShop\Filesystem\Controller;

use SixShop\Core\Helper;
use SixShop\Core\Middleware\MacroPageMiddleware;
use SixShop\Filesystem\Entity\FilesystemFileEntity;
use think\facade\Event;
use think\Request;
use think\Response;

class FileController
{
    protected array $middleware = [
        MacroPageMiddleware::class
    ];

    public function index(Request $request, FilesystemFileEntity $filesystemFileEntity): Response
    {
        $params = $request->get([
            'category_id/d' => -1,
            'keyword/s',
        ]);

        return Helper::page_response($filesystemFileEntity->getPage($params, $request->pageAndLimit()));
    }

    public function save(Request $request, FilesystemFileEntity $filesystemFileEntity): Response
    {
        $categoryId = $request->post('category_id/d', 0);
        $file = $request->file('file');
        validate([
            'category_id' => 'egt:0',
            'file' => 'require|fileSize:'.(1024*1024*100).',fileExt:png,jpg,jpeg,gif,fileMime:image/png,image/jpg,image/jpeg,image/gif',
        ], [
            'category_id.egt' => '分类ID不能小于0',
            'file.require' => '请选择文件',
            'file.fileSize' => '文件过大',
            'file.fileExt' => '文件格式错误',
            'file.fileMime' => '文件格式错误',
        ])->check([
            'category_id' => $categoryId,
            'file' => $file,
        ]);

        $result = $filesystemFileEntity->upload($categoryId, $file);

        return Helper::success_response($result);
    }

    public function delete(int $id, FilesystemFileEntity $filesystemFileEntity): Response
    {
        $result = $filesystemFileEntity->destroy($id);
        Event::trigger('after_filesystem_delete', $id);
        return Helper::success_response($result);
    }

    public function update(int $id, Request $request, FilesystemFileEntity $filesystemFileEntity): Response
    {
        $data = $request->post([
            'name/s' => '',
        ]);
        $result = $filesystemFileEntity->update($data, ['id' => $id]);
        return Helper::success_response($result);
    }
}