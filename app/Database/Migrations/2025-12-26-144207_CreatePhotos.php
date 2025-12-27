<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePhotos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'content_id' => ['type' => 'INT', 'unsigned' => true],
            'path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'caption' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_primary' => ['type' => 'BOOLEAN', 'default' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('content_id');
        $this->forge->createTable('photos');
    }

    public function down()
    {
        $this->forge->dropTable('photos');
    }
}
