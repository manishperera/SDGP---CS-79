<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class WasteFactoriesMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('waste_factories')
            ->addColumn('name', 'string', ['length' => 255])
            ->addColumn('details', 'text')
            ->addColumn('image', 'string', ['length' => 255, 'default' => null])
            ->addColumn('contact', 'string', ['length' => 50, 'default' => null])
            ->addColumn('efficiency', 'integer', ['default' => null])
            ->create();
    }

    protected function down(): void
    {
        $this->table('waste_factories')
            ->drop();
    }
}
