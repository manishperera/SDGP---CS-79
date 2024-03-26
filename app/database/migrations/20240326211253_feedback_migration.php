<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class FeedbackMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('feedback')
            ->addColumn('rating', 'integer')
            ->addColumn('improvements', 'text', ['null' => true])
            ->addColumn('suggestions', 'text', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    protected function down(): void
    {
        $this->table('feedback')
            ->drop();
    }
}
