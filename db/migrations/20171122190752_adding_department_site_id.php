<?php


use Phinx\Migration\AbstractMigration;

class AddingDepartmentSiteId extends AbstractMigration
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
    public function up()
    {
        $table = $this->table('Department');
        $table->addColumn('site_id', 'integer', ['limit' => 10, 'signed' => 0, 'null' => true])->update();
        $this->query('update `Department` set `site_id`=1 where 1');
        $table->addForeignKey('site_id', 'Site', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->save();
    }
    public function down()
    {
        $table = $this->table('Department');
        $table->dropForeignKey('site_id');
        $table->removeColumn('site_id')
            ->save();
    }

}
