<?php
declare(strict_types=1);


if (!function_exists('file_url')) {
    /**
     * 获取文件的URL
     * @param string $path 文件路径
     * @return string 文件URL
     */
    function file_url(string $path): string
    {
        return extension_config('filesystem', 'domain').'/'.$path;
    }
}