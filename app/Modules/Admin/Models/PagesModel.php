<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class PagesModel extends Model
{
    protected $table      = 'active_pages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'enabled'];

    public function getPages($active = null, $advanced = false)
    {
        $builder = $this->db->table($this->table);

        if (!is_null($active)) {
            $builder->where('enabled', $active);
        }

        $builder->select($advanced ? '*' : 'name');

        $result = $builder->get();

        if ($result->getNumRows() > 0) {
            if ($advanced) {
                return $result->getResultArray();
            } else {
                return array_column($result->getResultArray(), 'name');
            }
        }

        return [];
    }

    public function setPage($name)
    {
        // In CI4, load models using new operator or service locator
        $languagesModel = model(\App\Modules\Admin\Models\LanguagesModel::class);

        $name = strtolower($name);
        $name = str_replace(' ', '-', $name);

        $this->db->transBegin();

        $insertData = [
            'name'    => $name,
            'enabled' => 1
        ];

        if (!$this->db->table($this->table)->insert($insertData)) {
            log_message('error', print_r($this->db->error(), true));
        }

        $thisId    = $this->db->insertID();
        $languages = $languagesModel->getLanguages();

        foreach ($languages as $language) {
            $translationData = [
                'for_id' => $thisId,
                'abbr'   => $language->abbr
            ];

            if (!$this->db->table('textual_pages_tanslations')->insert($translationData)) {
                log_message('error', print_r($this->db->error(), true));
            }
        }

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            throw new \RuntimeException(lang('database_error'));
        } else {
            $this->db->transCommit();
        }
    }

    public function deletePage($id)
    {
        $this->db->transBegin();

        if (!$this->db->table($this->table)->delete(['id' => $id])) {
            log_message('error', print_r($this->db->error(), true));
        }

        if (!$this->db->table('textual_pages_tanslations')->delete(['for_id' => $id])) {
            log_message('error', print_r($this->db->error(), true));
        }

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            throw new \RuntimeException(lang('database_error'));
        } else {
            $this->db->transCommit();
        }
    }
}