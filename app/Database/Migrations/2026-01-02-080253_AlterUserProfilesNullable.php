<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserProfilesNullable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('user_profiles', [
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('user_profiles', [
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);
    }
}
