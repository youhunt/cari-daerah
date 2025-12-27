<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContentCategories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 100],
            'icon' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'is_active' => ['type' => 'BOOLEAN', 'default' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('content_categories');
    }

    public function down()
    {
        $this->forge->dropTable('content_categories');
    }
}
