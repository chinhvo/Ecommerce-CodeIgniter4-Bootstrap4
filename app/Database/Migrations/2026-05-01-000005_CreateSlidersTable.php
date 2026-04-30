<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSlidersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => false,
            ],
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'default'    => null,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 300,
                'null'       => true,
                'default'    => null,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'null'       => false,
            ],
            'active_from' => [
                'type' => 'DATE',
                'null' => true,
                'default' => null,
            ],
            'active_to' => [
                'type' => 'DATE',
                'null' => true,
                'default' => null,
            ],
            'position' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('sliders');
    }

    public function down()
    {
        $this->forge->dropTable('sliders', true);
    }
}
