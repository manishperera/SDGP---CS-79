<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;

final class ChatMessagesMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('chat_messages')
            ->addColumn('sender_id', 'integer')
            ->addColumn('receiver_id', 'integer')
            ->addColumn('message', 'text')
            ->addColumn('timestamp', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    protected function down(): void
    {
        $this->table('chat_messages')
            ->drop();
    }
}
