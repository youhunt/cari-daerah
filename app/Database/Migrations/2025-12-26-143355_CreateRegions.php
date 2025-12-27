<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRegions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],

            'province_code' => ['type' => 'int'],
            'province_name' => ['type' => 'VARCHAR', 'constraint' => 100],

            'city_code' => ['type' => 'int'],
            'city_name' => ['type' => 'VARCHAR', 'constraint' => 100],

            'district_code' => ['type' => 'int'],
            'district_name' => ['type' => 'VARCHAR', 'constraint' => 100],

            'village_code' => ['type' => 'bigint'],
            'village_name' => ['type' => 'VARCHAR', 'constraint' => 100],

            'slug' => ['type' => 'VARCHAR', 'constraint' => 255],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['province_code', 'city_code', 'district_code']);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('regions');
    }

    public function down()
    {
        $this->forge->dropTable('regions');
    }
}
