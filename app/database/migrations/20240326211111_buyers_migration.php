<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;
use Phoenix\Database\Element\Column;

final class BuyersMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('buyers')
            ->addPrimaryColumns([new Column('user_id', 'integer', ['autoincrement' => true])])
            ->addColumn('email', 'string', ['length' => 150])
            ->addColumn('user_name', 'string', ['length' => 150])
            ->addColumn('phone_number', 'string', ['length' => 15])
            ->addColumn('password', 'string', ['length' => 150])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('reset_code', 'string', ['length' => 16])
            ->create();

        $this->table('buyers')
            ->addUniqueConstraint('email', 'u_email')
            ->save();
    }

    protected function down(): void
    {
        $this->table('buyers')
            ->drop();
    }
}