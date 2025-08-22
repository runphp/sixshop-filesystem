<?php
declare(strict_types=1);

namespace SixShop\Filesystem\Controller;


use SixShop\Core\Helper;
use SixShop\Filesystem\Model\FilesystemCategoryModel;
use SixShop\Filesystem\Model\FilesystemFileModel;
use think\Request;
use think\response\Json;

class CategoryController
{
    public function index(): Json
    {
        $list = FilesystemCategoryModel::order(['sort' => 'asc', 'id' => 'asc'])->select();
        $list = $list->toArray();
        $list[] = [
            'id' => 0,
            'name' => '未分类',
            'sort' => 0,
            'file_count' => FilesystemFileModel::where('category_id', 0)->count(),
        ];
        $list[] = [
            'id' => -1,
            'name' => '所有文件',
            'sort' => 0,
            'file_count' => array_sum(array_column($list, 'file_count')),
        ];
        return Helper::success_response($list);
    }

    public function save(Request $request): Json
    {
        $data = $request->post([
            'name/s',
            'sort/d',
        ]);
        $result = FilesystemCategoryModel::create($data);

        return Helper::success_response($result);

    }

    public function update(int $id, Request $request): Json
    {
        $data = $request->post([
            'name/s',
            'sort/d',
        ]);
        $result = FilesystemCategoryModel::findOrFail($id)->save($data);

        return Helper::success_response($result);
    }

    public function delete(int $id): Json
    {
        $result = FilesystemCategoryModel::destroy($id);

        return Helper::success_response($result);
    }
}