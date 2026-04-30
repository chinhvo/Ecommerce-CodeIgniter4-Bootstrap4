<?php
namespace App\Modules\Admin\Controllers\Blog;

use App\Core\AdminController;
use App\Core\BlogType;

class Blog extends AdminController
{
    protected $Blog_model;
    private $num_rows = 10;

    public function __construct()
    {
        parent::__construct();
        $this->Blog_model = model(\App\Modules\Admin\Models\BlogModel::class);
    }

    public function index($page = 0)
    {
        $this->login_check();

        // Delete post
        if ($this->request->getGet('delete')) {
            $this->Blog_model->deletePost($this->request->getGet('delete'));
            return redirect()->to('admin/blog');
        }

        $head = [
            'title'       => 'Administration - Blog Posts',
            'description' => '!',
            'keywords'    => ''
        ];

        $search = $this->request->getGet('search') ?? null;
        $blogTypeRaw = $this->request->getGet('blog_type');
        $blogType = is_numeric($blogTypeRaw) ? BlogType::normalize($blogTypeRaw) : null;

        $paginationBase = 'admin/blog';
        if ($blogType !== null) {
            $paginationBase .= '?blog_type=' . $blogType;
            if (!empty($search)) {
                $paginationBase .= '&search=' . urlencode($search);
            }
        } elseif (!empty($search)) {
            $paginationBase .= '?search=' . urlencode($search);
        }

        $rowscount = $this->Blog_model->postsCountByType($search, MY_DEFAULT_LANGUAGE_ABBR, $blogType);
        $data['posts'] = $this->Blog_model->getPosts(null, $this->num_rows, $page, $search, null, $blogType);
        $data['links_pagination'] = pagination($paginationBase, $rowscount, $this->num_rows, 3);
        $data['page'] = $page;
        $data['num_rows'] = $this->num_rows;
        $data['blogTypes'] = BlogType::labels();
        $data['selectedBlogType'] = $blogType;

        echo view('\App\Modules\Admin\Views\Blog\blogposts', array_merge($data, $head));
        
        if ($page == 0) {
            $this->saveHistory('Go to Blog');
        }
    }
}