<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class ItemsMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('items')
            ->addColumn('weight', 'string', ['length' => 255, 'default' => null])
            ->addColumn('price', 'string', ['length' => 255, 'default' => null])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    protected function down(): void
    {
        $this->table('items')
            ->drop();
    }
}
