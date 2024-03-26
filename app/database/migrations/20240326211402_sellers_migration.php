<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class SellersMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('sellers')
            ->addColumn('email', 'string', ['length' => 255])
            ->addColumn('seller_name', 'string', ['length' => 255])
            ->addColumn('phone_number', 'string', ['length' => 255])
            ->addColumn('address', 'text')
            ->addColumn('password', 'string', ['length' => 255])
            ->addColumn('business_type', 'enum', ['values' => ['Restaurant', 'Hotel', 'Grocery Stores', 'House/Resident']])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    protected function down(): void
    {
        $this->table('sellers')
            ->drop();
    }
}
