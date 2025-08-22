<?php

use think\migration\Migrator;

class ExtensionFilesystemFile extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('extension_filesystem_file', [
            'comment' => '文件表',
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci',
            'id' => false,
            'primary_key' => 'id'
        ]);
        $table
            ->addColumn('id', 'integer', [
                'identity' => true,
                'signed' => false,
                'comment' => '主键'
            ])
            ->addColumn('category_id', 'integer', [
                'default' => 0,
                'signed' => false,
                'comment' => '分类id'
            ])
            ->addColumn('file_hash', 'string', [
                'default' => '',
                'comment' => '文件hash'
            ])->addColumn('name', 'string', [
                'default' => '',
                'comment' => '文件备注名称'
            ])->addColumn('file_name', 'string', [
                'default' => '',
                'comment' => '文件名'
            ])->addColumn('file_path', 'string', [
                'default' => '',
                'comment' => '文件路径'
            ])->addColumn('file_size', 'integer', [
                'default' => 0,
                'comment' => '文件大小'
            ])->addColumn('file_ext', 'string', [
                'default' => '',
                'comment' => '文件类型'
            ])->addColumn('file_mine', 'string', [
                'default' => '',
                'comment' => '文件MIME'
            ])->addColumn('file_url', 'string', [
                'default' => '',
                'comment' => '文件URL'
            ])->addColumn('create_time', 'datetime', [
                'null' => true,
                'comment' => '创建时间'
            ])->addColumn('update_time', 'datetime', [
                'null' => true,
                'comment' => '更新时间'
            ])->addColumn('delete_time', 'datetime', [
                'null' => true,
                'comment' => '删除时间'
            ])->addIndex('file_hash', [
                'name' => 'file_hash'
            ])->create();
    }
}
