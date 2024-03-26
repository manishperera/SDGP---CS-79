<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;
use Phoenix\Database\Element\Column;

final class ChatsMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('chats')
            ->addPrimaryColumns([new Column('chat_id', 'integer', ['autoincrement' => true])])
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
