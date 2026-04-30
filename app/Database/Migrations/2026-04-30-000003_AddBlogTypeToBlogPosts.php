<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBlogTypeToBlogPosts extends Migration
{
    public function up()
    {
        $fields = [
            'blog_type' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 4,
                'after'      => 'time',
            ],
        ];

        $this->forge->addColumn('blog_posts', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('blog_posts', 'blog_type');
    }
}
