<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIconToShopCategories extends Migration
{
    public function up()
    {
        $fields = [
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null'       => true,
                'after'      => 'position',
            ],
        ];

        $this->forge->addColumn('shop_categories', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('shop_categories', 'icon');
    }
}
