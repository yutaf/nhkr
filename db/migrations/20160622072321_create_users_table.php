<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateUsersTable extends AbstractMigration
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
        // create the table
        $table = $this->table('users');
        $table->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('area', 'integer', ['limit' => MysqlAdapter::INT_SMALL, 'signed' => false])
            ->addColumn('locale', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
