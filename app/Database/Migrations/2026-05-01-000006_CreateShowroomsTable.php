<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShowroomsTable extends Migration
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
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => false,
            ],
            'google_map_location' => [
                'type'       => 'VARCHAR',
                'constraint' => 1000,
                'null'       => true,
                'default'    => null,
            ],
            'contact_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null'       => true,
                'default'    => null,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 190,
                'null'       => true,
                'default'    => null,
            ],
            'representative_person' => [
                'type'       => 'VARCHAR',
                'constraint' => 190,
                'null'       => true,
                'default'    => null,
            ],
            'main_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 300,
                'null'       => true,
                'default'    => null,
            ],
            'additional_information' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'null'       => false,
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
        $this->forge->createTable('showrooms');
    }

    public function down()
    {
        $this->forge->dropTable('showrooms', true);
    }
}
