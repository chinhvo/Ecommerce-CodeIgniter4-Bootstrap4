<?php
namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;

class Pages extends AdminController
{
    protected $Pages_model;

    public function __construct()
    {
        parent::__construct();
        $this->Pages_model = model(\App\Modules\Admin\Models\PagesModel::class);
    }

    public function index()
    {
        $this->login_check();

        $head = [
            'title'       => 'Administration - Pages Manage',
            'description' => '!',
            'keywords'    => ''
        ];

        $data = [
            'pages' => $this->Pages_model->getPages(null, true)
        ];

        if ($this->request->getPost('pname')) {
            $pname = $this->request->getPost('pname');
            $this->Pages_model->setPage($pname);
            $this->saveHistory('Add new page with name - ' . $pname);
            return redirect()->to('admin/pages');
        }

        if ($this->request->getGet('delete')) {
            $this->Pages_model->deletePage($this->request->getGet('delete'));
            $this->saveHistory('Delete page');
            return redirect()->to('admin/pages');
        }

        echo view('\App\Modules\Admin\Views\settings\pages', array_merge($data, $head));
        

        $this->saveHistory('Go to Pages manage');
    }
}