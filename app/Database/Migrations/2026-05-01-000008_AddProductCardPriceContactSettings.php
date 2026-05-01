<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductCardPriceContactSettings extends Migration
{
    public function up()
    {
        $builder = $this->db->table('value_store');

        $existsShowPrice = $builder->where('thekey', 'showProductPrice')->countAllResults();
        if ($existsShowPrice === 0) {
            $builder->insert([
                'thekey' => 'showProductPrice',
                'value' => '1',
            ]);
        }
    }

    public function down()
    {
        $builder = $this->db->table('value_store');
        $builder->where('thekey', 'showProductPrice')->delete();
    }
}
