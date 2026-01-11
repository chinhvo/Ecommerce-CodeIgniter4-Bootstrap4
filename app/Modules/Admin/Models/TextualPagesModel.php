<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class TextualPagesModel extends Model
{
    protected $table      = 'active_pages';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'enabled']; // fields for active_pages table

    public function getOnePageForEdit(string $pname): array
    {
        return $this->db->table('active_pages')
            ->select('active_pages.id, textual_pages_tanslations.description, textual_pages_tanslations.abbr, textual_pages_tanslations.name, languages.name as lname, languages.flag')
            ->join('textual_pages_tanslations', 'textual_pages_tanslations.for_id = active_pages.id', 'left')
            ->join('languages', 'textual_pages_tanslations.abbr = languages.abbr', 'left')
            ->where('active_pages.enabled', 1)
            ->where('active_pages.name', $pname)
            ->get()
            ->getResultArray();
    }

    public function setEditPageTranslations(array $post): void
    {
        $table = $this->db->table('textual_pages_tanslations');

        foreach ($post['translations'] as $i => $abbr) {
            $updateData = [
                'name'        => $post['name'][$i],
                'description' => $post['description'][$i]
            ];

            $success = $table->where('abbr', $abbr)
                             ->where('for_id', $post['pageId'])
                             ->update($updateData);

            if (!$success) {
                log_message('error', print_r($this->db->error(), true));
                throw new \RuntimeException(lang('database_error'));
            }
        }
    }

    public function changePageStatus(int $id, int $to_status): bool
    {
        return $this->db->table('active_pages')
            ->where('id', $id)
            ->update(['enabled' => $to_status]);
    }
}