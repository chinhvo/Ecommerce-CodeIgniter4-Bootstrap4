<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class LanguagesModel extends Model
{
    protected $table      = 'languages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'abbr'];

    public function deleteLanguage(int $id): bool
    {
        $row = $this->db->table('languages')
            ->select('abbr')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$row) {
            return false;
        }

        $abbr = $row['abbr'];

        $this->db->transStart();

        $this->db->table('languages')->delete(['id' => $id]);
        $this->db->table('products_translations')->delete(['abbr' => $abbr]);
        $this->db->table('shop_categories_translations')->delete(['abbr' => $abbr]);
        $this->db->table('textual_pages_tanslations')->delete(['abbr' => $abbr]);
        $this->db->table('blog_translations')->delete(['abbr' => $abbr]);
        $this->db->table('cookie_law_translations')->delete(['abbr' => $abbr]);

        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function countLangs(?string $name = null, ?string $abbr = null): int
    {
        $builder = $this->db->table('languages');

        if ($name !== null) {
            $builder->where('name', $name);
        }
        if ($abbr !== null) {
            $builder->orWhere('abbr', $abbr);
        }

        return $builder->countAllResults();
    }

    public function getLanguages(): array
    {
        return $this->db->table('languages')->get()->getResult();
    }

    public function setLanguage(array $post): bool
    {
        $data = [
            'name' => strtolower($post['name']),
            'abbr' => strtolower($post['abbr']),
        ];

        return $this->db->table('languages')->insert($data);
    }
}