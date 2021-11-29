<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateBillReceiveTable extends AbstractMigration
{
    public function up()
    {
        $this->table('bill_receives')
            ->addColumn('date_launch','date')
            ->addColumn('name','string')
            ->addColumn('value','float')
            ->addColumn('user_id','integer')
            ->addColumn('created_at','datetime')
            ->addColumn('updated_at','datetime')
            ->addForeignKey('user_id','users','id')
            ->save();
    }

    public function down()
    {
        $this->dropTable('bill_receives');
    }
}

