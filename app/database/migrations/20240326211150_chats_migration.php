<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class ChatsMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('chats', 'chat_id')
            ->addColumn('from_id', 'integer')
            ->addColumn('to_id', 'integer')
            ->addColumn('message', 'text')
            ->addColumn('opened', 'boolean', ['default' => 0])
            ->addColumn('created_at', 'datetime')
            ->create();
    }

    protected function down(): void
    {
        $this->table('chats')
            ->drop();
    }
}
