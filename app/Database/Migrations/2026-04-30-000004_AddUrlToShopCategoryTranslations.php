<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUrlToShopCategoryTranslations extends Migration
{
    public function up()
    {
        $fields = [
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true,
                'after' => 'name',
            ],
        ];

        $this->forge->addColumn('shop_categories_translations', $fields);

        $rows = $this->db->table('shop_categories_translations')
            ->select('id, name, for_id')
            ->get()
            ->getResultArray();

        foreach ($rows as $row) {
            $slug = $this->slugify((string) $row['name']) . '-' . (int) $row['for_id'];

            $this->db->table('shop_categories_translations')
                ->where('id', $row['id'])
                ->update(['url' => $slug]);
        }

        $this->db->query('CREATE INDEX idx_shop_categories_translations_url ON shop_categories_translations (url)');
    }

    public function down()
    {
        $this->db->query('DROP INDEX idx_shop_categories_translations_url ON shop_categories_translations');
        $this->forge->dropColumn('shop_categories_translations', 'url');
    }

    private function slugify(string $value): string
    {
        $value = trim($value);
        $ascii = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);

        if ($ascii === false) {
            $ascii = $value;
        }

        $slug = strtolower($ascii);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? '';
        $slug = trim($slug, '-');

        return $slug !== '' ? $slug : 'category';
    }
}
