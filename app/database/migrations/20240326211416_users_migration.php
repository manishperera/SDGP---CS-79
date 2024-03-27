<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;
use Phoenix\Database\Element\Column;

final class UsersMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('users')
            ->addPrimaryColumns([new Column('user_id', 'integer', ['autoincrement' => true])])
            ->addColumn('name', 'string', ['length' => 255])
            ->addColumn('username', 'string', ['length' => 255])
            ->addColumn('password', 'string', ['length' => 1000])
            ->addColumn('p_p', 'string', ['length' => 255, 'default' => 'user-default.png'])
            ->addColumn('last_seen', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    protected function down(): void
    {
        $this->table('users')
            ->drop();
    }
}
