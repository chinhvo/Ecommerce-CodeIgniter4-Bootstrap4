<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHighlightedToProducts extends Migration
{
    public function up()
    {
        $fields = [
            'highlighted' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 0,
                'after'      => 'in_slider',
            ],
        ];

        $this->forge->addColumn('products', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('products', 'highlighted');
    }
}
