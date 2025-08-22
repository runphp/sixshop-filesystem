<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ExtensionFilesystemCagegory extends Migrator
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
    public function change(): void
    {
        $table = $this->table('extension_filesystem_category', [
            'comment' => '文件分类表',
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci',
            'id' => false,
            'primary_key' => 'id'
        ]);
        $table->addColumn('id', 'integer', [
            'identity' => true,
            'signed' => false,
            'comment' => '主键'
        ])->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
            'comment' => '名称'
        ])->addColumn('parent_id', 'integer', [
            'signed' => false,
            'null' => true,
            'default' => 0,
            'comment' => '父级ID'
        ])->addColumn('level', 'integer', [
            'signed' => false,
            'null' => false,
            'default' => 0,
            'comment' => '层级'
        ])->addColumn('sort', 'integer', [
           'signed' => false,
            'null' => false,
            'default' => 0,
            'comment' => '排序'
        ])->addColumn('file_count', 'integer',[
            'signed' => false,
            'null' => false,
            'default' => 0,
            'comment' => '文件数量'
        ])->addTimestamps()
            ->addSoftDelete()
            ->create();
    }
}
