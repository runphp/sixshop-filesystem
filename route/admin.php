<?php
declare(strict_types=1);

use SixShop\Filesystem\Controller\{
    CategoryController,
    FileController
};
use think\facade\Route;

Route::resource('category', CategoryController::class)->middleware([
    'auth'
]);
Route::resource('file', FileController::class)->middleware([
    'auth'
]);