<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class WasteMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('waste')
            ->addColumn('name', 'string', ['length' => 255])
            ->addColumn('weight', 'decimal', ['length' => 10, 'decimals' => 2])
            ->addColumn('price', 'string', ['length' => 100, 'default' => 'donated'])
            ->addColumn('image', 'string', ['length' => 255, 'default' => null])
            ->addColumn('category', 'enum', ['values' => 'food', 'waste'])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('contact', 'string', ['length' => 50, 'default' => null])
            ->addColumn('address', 'text', ['null' => true])
            ->addColumn('ratings', 'decimal', ['length' => 3, 'decimals' => 2, 'default' => null])
            ->addColumn('seller_id', 'integer')
            ->addColumn('is_donation', 'string', ['length' => 6, 'default' => 0])
            ->create();

        $this->table('donations')
            ->addIndex('seller_id')
            ->save();
    }

    protected function down(): void
    {
        $this->table('waste')
            ->drop();
    }
}
