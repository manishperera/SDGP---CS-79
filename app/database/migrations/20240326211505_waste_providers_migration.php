<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class WasteProvidersMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('waste_providers')
            ->addColumn('name', 'string', ['length' => 255])
            ->addColumn('address', 'string', ['length' => 255, 'default' => null])
            ->addColumn('contact', 'string', ['length' => 50, 'default' => null])
            ->addColumn('efficiency', 'integer', ['default' => null])
            ->addColumn('image', 'string', ['length' => 255, 'default' => null])
            ->addColumn('details', 'text')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    protected function down(): void
    {
        $this->table('waste_providers')
            ->drop();
    }
}
