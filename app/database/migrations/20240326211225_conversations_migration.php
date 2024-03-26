<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class ConversationsMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('conversations', 'conversation_id')
            ->addColumn('user_1', 'integer')
            ->addColumn('user_2', 'integer')
            ->create();
    }

    protected function down(): void
    {
        $this->table('conversations')
            ->drop();
    }
}
