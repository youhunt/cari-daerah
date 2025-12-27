<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContentMeta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'content_id' => ['type' => 'INT', 'unsigned' => true],
            'meta_key' => ['type' => 'VARCHAR', 'constraint' => 100],
            'meta_value' => ['type' => 'TEXT'],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['content_id', 'meta_key']);
        $this->forge->createTable('content_meta');
    }

    public function down()
    {
        $this->forge->dropTable('content_meta');
    }
}
