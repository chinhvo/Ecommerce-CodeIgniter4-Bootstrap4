<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class TitlesModel extends Model
{
    protected $table      = 'seo_pages_translations';
    protected $primaryKey = 'id'; // Change if needed
    protected $returnType = 'array';
    protected $allowedFields = ['page_type', 'abbr', 'title', 'description'];

    public function setSeoPageTranslations(array $post): void
    {
        $translationsTable = $this->db->table('seo_pages_translations');

        $i = 0;
        foreach ($post['pages'] as $page) {
            foreach ($post['translations'] as $abbr) {

                $exists = $translationsTable
                    ->where('abbr', $abbr)
                    ->where('page_type', $page)
                    ->countAllResults();

                $data = [
                    'page_type'   => $page,
                    'abbr'        => $abbr,
                    'title'       => $post['title'][$i],
                    'description' => $post['description'][$i]
                ];

                if ($exists === 0) {
                    if (!$translationsTable->insert($data)) {
                        log_message('error', print_r($this->db->error(), true));
                        throw new \RuntimeException(lang('database_error'));
                    }
                } else {
                    if (!$translationsTable
                        ->where('abbr', $abbr)
                        ->where('page_type', $page)
                        ->update($data)
                    ) {
                        log_message('error', print_r($this->db->error(), true));
                        throw new \RuntimeException(lang('database_error'));
                    }
                }

                $i++;
            }
        }
    }

    public function getSeoTranslations(): array
    {
        $result = $this->db->table('seo_pages_translations')->get()->getResultArray();
        $arr = [];

        foreach ($result as $row) {
            $arr[$row['page_type']][$row['abbr']] = [
                'title'       => $row['title'],
                'description' => $row['description']
            ];
        }

        return $arr;
    }

    public function getSeoPages(): array
    {
        return $this->db->table('seo_pages')->get()->getResultArray();
    }
}
