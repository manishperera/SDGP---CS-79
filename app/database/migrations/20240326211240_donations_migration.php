<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class DonationsMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('donations')
            ->addColumn('name', 'string', ['length' => 255])
            ->addColumn('weight', 'decimal', ['length' => 10, 'decimals' => 2])
            ->addColumn('category', 'string', ['length' => 50])
            ->addColumn('image', 'string', ['length' => 255, 'default' => null])
            ->addColumn('seller_id', 'integer', ['default' => null])
            ->addColumn('created_at', 'timestamp')
            ->create();

        $this->table('donations')
            ->addIndex('seller_id')
            ->save();
    }

    protected function down(): void
    {
        $this->table('donations')
            ->drop();
    }
}
