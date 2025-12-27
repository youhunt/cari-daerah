<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProfiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'full_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'trust_level' => [
                'type' => 'ENUM',
                'constraint' => ['new', 'active', 'trusted'],
                'default' => 'new'
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('user_id', true);
        $this->forge->createTable('user_profiles');
    }

    public function down()
    {
        $this->forge->dropTable('user_profiles');
    }
}
