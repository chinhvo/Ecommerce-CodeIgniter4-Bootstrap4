<?php
namespace App\Modules\Admin\Controllers\Blog;

use App\Core\AdminController;
use App\Core\BlogType;

class BlogPublish extends AdminController
{
    protected $Blog_model;
    protected $Languages_model;

    public function __construct()
    {
        parent::__construct();
        $this->Blog_model      = model(\App\Modules\Admin\Models\BlogModel::class);
        $this->Languages_model = model(\App\Modules\Admin\Models\LanguagesModel::class);
    }

    public function index($id = 0)
    {
        $this->login_check();
        $trans_load = null;

        // Load existing post for editing
        if ($id > 0 && ($this->request->getPost() === null || count($this->request->getPost()) === 0)) {
            $postData = $this->Blog_model->getOnePost($id);
            if ($postData) {
                $_POST = $postData; // Only if you still rely on POST-like behavior in views
            }
            $trans_load = $this->Blog_model->getTranslations($id);
        }

        // Handle form submission
        if ($this->request->getPost('submit') != null) {
            $postData = $this->request->getPost();
            $postData['blog_type'] = BlogType::normalize($postData['blog_type'] ?? null);
            $postData['image'] = $this->uploadImage();
            $this->Blog_model->setPost($postData, $id);

            session()->setFlashdata('result_publish', lang('successful_published'));
            return redirect()->to('admin/blog');
        }

        $head = [
            'title'       => 'Administration - Publish Blog Post',
            'description' => '!',
            'keywords'    => ''
        ];

        $data = [
            'id'         => $id,
            'languages'  => $this->Languages_model->getLanguages(),
            'trans_load' => $trans_load,
            'blogTypes'  => BlogType::labels(),
        ];


        echo view('\App\Modules\Admin\Views\Blog\blogpublish', array_merge($data, $head));        

        $this->saveHistory('Go to Blog Publish');
    }

    private function uploadImage()
    {
        $file = $this->request->getFile('userfile');

        if (!$file || !$file->isValid()) {
            log_message('error', 'Image Upload Error: ' . ($file ? $file->getErrorString() : 'No file uploaded'));
            return null;
        }

        $newName = $file->getRandomName();
        $uploadPath = FCPATH . 'attachments' . DIRECTORY_SEPARATOR . 'blog_images' . DIRECTORY_SEPARATOR;

        if (!$file->move($uploadPath, $newName)) {
            log_message('error', 'Image Upload Move Error');
            return null;
        }

        return $newName;
    }
}
