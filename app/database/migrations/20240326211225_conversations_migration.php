<?php

declare(strict_types=1);

namespace Migrations;

use Phoenix\Migration\AbstractMigration;
use Phoenix\Database\Element\Column;

final class ConversationsMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('conversations')
            ->addPrimaryColumns([new Column('conversation_id', 'integer', ['autoincrement' => true])])
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
