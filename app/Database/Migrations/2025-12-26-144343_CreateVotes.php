<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVotes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'content_id' => ['type' => 'INT', 'unsigned' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true],
            'vote' => ['type' => 'ENUM', 'constraint' => ['up', 'down']],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['content_id', 'user_id']);
        $this->forge->createTable('votes');
    }

    public function down()
    {
        $this->forge->dropTable('votes');
    }
}
