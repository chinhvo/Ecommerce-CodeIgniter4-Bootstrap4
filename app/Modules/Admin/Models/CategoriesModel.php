<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use RuntimeException;

class CategoriesModel extends Model
{
    protected $table = 'shop_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sub_for', 'position', 'icon'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function categoriesCount(): int
    {
        return $this->countAll();
    }

    public function getShopCategories(int $limit = null, int $start = null): array
    {
        $builder = $this->db->table('shop_categories_translations as translations_first')
            ->select('translations_first.*, 
                (SELECT name FROM shop_categories_translations 
                 WHERE for_id = sub_for AND abbr = translations_first.abbr) as sub_is, 
                shop_categories.id,
                shop_categories.sub_for,
                shop_categories.position,
                shop_categories.icon')
            ->join('shop_categories', 'shop_categories.id = translations_first.for_id')
            ->orderBy('position', 'ASC');

        if ($limit !== null && $start !== null) {
            $builder->limit($limit, $start);
        }

        $query = $builder->get();
        $arr = [];

        foreach ($query->getResult() as $row) {
            $arr[$row->for_id]['info'][] = [
                'abbr' => $row->abbr,
                'name' => $row->name,
                'url' => $row->url,
                'sub_for' => $row->sub_for
            ];
            $arr[$row->for_id]['sub'][] = $row->sub_is;
            $arr[$row->for_id]['sub_for'] = $row->sub_for;
            $arr[$row->for_id]['position'] = $row->position;
            $arr[$row->for_id]['icon'] = $row->icon;
        }

        return $arr;
    }

    public function deleteShopCategorie(int $id): void
    {
        $this->db->transStart();

        $this->db->table('shop_categories_translations')
            ->where('for_id', $id)
            ->delete();

        $this->db->table('shop_categories')
            ->groupStart()
                ->where('id', $id)
                ->orWhere('sub_for', $id)
            ->groupEnd()
            ->delete();

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            throw new RuntimeException(lang('database_error'));
        }
    }

    public function setShopCategorie(array $post): void
    {
        $this->db->transStart();

        $this->insert([
            'sub_for' => $post['sub_for'],
            'icon'    => trim((string) ($post['icon'] ?? '')),
        ]);
        $id = $this->getInsertID();

        foreach ($post['translations'] as $i => $abbr) {
            $name = (string) ($post['categorie_name'][$i] ?? '');

            $this->db->table('shop_categories_translations')->insert([
                'abbr'   => $abbr,
                'name'   => $name,
                'url'    => $this->buildCategorySlug($name, (int) $id),
                'for_id' => $id
            ]);
        }

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            throw new RuntimeException(lang('database_error'));
        }
    }

    public function editShopCategorieSub(array $post): bool
    {
        if ($post['editSubId'] != $post['newSubIs']) {
            return $this->update($post['editSubId'], [
                'sub_for' => $post['newSubIs']
            ]);
        }
        return false;
    }

    public function editShopCategorie(array $post): void
    {
        $name = (string) ($post['name'] ?? '');
        $forId = (int) ($post['for_id'] ?? 0);

        $this->db->table('shop_categories_translations')
            ->where('abbr', $post['abbr'])
            ->where('for_id', $post['for_id'])
            ->update([
                'name' => $name,
                'url' => $this->buildCategorySlug($name, $forId),
            ]);
    }

    private function buildCategorySlug(string $name, int $id): string
    {
        helper(['text', 'vntostr', 'except_letters']);

        return vnToStr(except_letters(url_title($name, '-', true))) . '-' . $id;
    }

    public function editShopCategoriePosition(array $post): void
    {
        $this->update($post['editid'], [
            'position' => $post['new_pos']
        ]);
    }
}