<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class BlogModel extends Model
{
    protected $table         = 'blog_posts';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['image', 'time', 'url'];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    /**
     * Delete post and its translations
     */
    public function deletePost(int $id): void
    {
        $this->db->transException(true)->transStart();

        $this->db->table('blog_posts')->delete(['id' => $id]);
        $this->db->table('blog_translations')->delete(['for_id' => $id]);

        $this->db->transComplete();
    }

    /**
     * Count posts with optional search filter
     */
    public function postsCount(?string $search = null, string $lang = MY_DEFAULT_LANGUAGE_ABBR): int
    {
        $builder = $this->db->table('blog_posts')
            ->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left')
            ->where('blog_translations.abbr', $lang);

        if ($search) {
            $builder->like('blog_translations.title', $search);
        }

        return $builder->countAllResults();
    }

    /**
     * Get posts with filters
     */
    public function getPosts(
        ?string $lang = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $month = null
    ): array {
        $builder = $this->db->table('blog_posts')
            ->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image')
            ->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left')
            ->where('blog_translations.abbr', $lang ?? MY_DEFAULT_LANGUAGE_ABBR);

        if ($search) {
            $builder->groupStart()
                ->like('blog_translations.title', $search)
                ->orLike('blog_translations.description', $search)
                ->groupEnd();
        }

        if ($month) {
            $builder->where('time >=', $month['from'])
                    ->where('time <=', $month['to']);
        }

        return $builder->get($limit, $offset)->getResultArray();
    }

    /**
     * Insert or update a post
     */
    public function setPost(array $post, int $id): void
    {
        $this->db->transException(true)->transStart();

        if ($id > 0) {
            // Update
            $data = [
                'image' => $post['image'] ?? $post['old_image'] ?? null
            ];
            $this->db->table('blog_posts')->update($data, ['id' => $id]);
        } else {
            // Insert new
            $myTranslationNum = array_search(MY_DEFAULT_LANGUAGE_ABBR, $post['translations']);
            $this->db->table('blog_posts')->insert([
                'image' => $post['image'],
                'time'  => time()
            ]);
            $id = $this->db->insertID();

            $url = url_title($post['title'][$myTranslationNum] . '_' . $id, '-', true);
            $this->db->table('blog_posts')->update(['url' => $url], ['id' => $id]);
        }

        $this->setBlogTranslations($post, $id, $id > 0);

        $this->db->transComplete();
    }

    /**
     * Save translations
     */
    private function setBlogTranslations(array $post, int $id, bool $isUpdate): void
    {
        $currentTrans = $this->getTranslations($id);

        foreach ($post['translations'] as $i => $abbr) {
            $arr = [
                'title'       => str_replace('"', "'", $post['title'][$i]),
                'description' => $post['description'][$i],
                'abbr'        => $abbr,
                'for_id'      => $id
            ];

            if ($isUpdate && isset($currentTrans[$abbr])) {
                unset($arr['for_id'], $arr['abbr']);
                $this->db->table('blog_translations')
                    ->where(['abbr' => $abbr, 'for_id' => $id])
                    ->update($arr);
            } else {
                $this->db->table('blog_translations')->insert($arr);
            }
        }
    }

    /**
     * Get single post
     */
    public function getOnePost(int $id)
    {
        return $this->db->table('blog_posts')->where('id', $id)->get()->getRowArray() ?: false;
    }

    /**
     * Get translations for a post
     */
    public function getTranslations(int $id): array
    {
        $result = $this->db->table('blog_translations')->where('for_id', $id)->get()->getResult();
        $arr = [];
        foreach ($result as $row) {
            $arr[$row->abbr] = [
                'title'       => $row->title,
                'description' => $row->description
            ];
        }
        return $arr;
    }
}