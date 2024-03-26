<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class ProductsMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('products')
            ->addColumn('name', 'string', ['length' => 255])
            ->addColumn('price', 'decimal', ['length' => 10, 'decimals' => 2])
            ->addColumn('image', 'string', ['length' => 255])
            ->create();
    }

    protected function down(): void
    {
        $this->table('products')
            ->drop();
    }
}
