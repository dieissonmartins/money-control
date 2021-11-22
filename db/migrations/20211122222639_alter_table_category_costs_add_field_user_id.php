<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AlterTableCategoryCostsAddFieldUserId extends AbstractMigration
{
    public function up()
    {
        $this->table('category_costs')
            ->addColumn('user_id','integer')
            ->save();
    }

    public function down()
    {
        $this->table('category_costs')
            ->removeColumn('user_id')
            ->save();
    }
}

