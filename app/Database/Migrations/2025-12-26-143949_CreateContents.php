<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],

            'user_id' => ['type' => 'INT', 'unsigned' => true],
            'category_id' => ['type' => 'INT', 'unsigned' => true],
            'region_id' => ['type' => 'INT', 'unsigned' => true],

            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 255],
            'summary' => ['type' => 'TEXT', 'null' => true],
            'content' => ['type' => 'LONGTEXT'],

            'latitude' => ['type' => 'DECIMAL', 'constraint' => '10,7', 'null' => true],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '10,7', 'null' => true],

            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'published', 'verified', 'flagged', 'archived'],
                'default' => 'draft'
            ],

            'views' => ['type' => 'INT', 'default' => 0],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('category_id');
        $this->forge->addKey('region_id');
        $this->forge->addKey('status');
        $this->forge->addUniqueKey('slug');

        $this->forge->createTable('contents');
    }

    public function down()
    {
        $this->forge->dropTable('contents');
    }
}
