<?php
namespace App\Modules\Admin\Controllers\Blog;

use App\Core\AdminController;

class Blog extends AdminController
{
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

        $rowscount = $this->Blog_model->postsCount($search);
        $data['posts'] = $this->Blog_model->getPosts(null, $this->num_rows, $page, $search);
        $data['links_pagination'] = pagination('admin/blog', $rowscount, $this->num_rows, 3);
        $data['page'] = $page;

        echo view('\App\Modules\Admin\Views\Blog\blogposts', array_merge($data, $head));
        
        if ($page == 0) {
            $this->saveHistory('Go to Blog');
        }
    }
}