<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AdminUser extends Migrator
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
        $table=$this->table('admin_user');
        $table->addColumn('uuid','string',['limit'=>16,'default'=>'','comment'=>'不重复的uuid码'])
            ->addColumn('group_id','integer',['limit'=>11,'default'=>0,'comment'=>'用户组ID'])
            ->addColumn('username','string',['limit'=>16,'default'=>'','comment'=>'用户登录名'])
            ->addIndex(['username'],['unique'=>true])
            ->addColumn('password','string',['limit'=>40])
            ->addColumn('rnd','string',['limit'=>32,'default'=>'','comment'=>'安全加固随机码'])
            ->addColumn('salt','string',['limit'=>32,'default'=>'','comment'=>'注册时随机生成一个加盐码'])
            ->addColumn('last_login','integer',['limit'=>11,'default'=>'','comment'=>'最后一次登录'])
            ->create();
    }
}