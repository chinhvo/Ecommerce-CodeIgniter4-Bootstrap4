<?php

namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;

class Styling extends AdminController
{
    protected $homeAdminModel;

    public function __construct()
    {
        parent::__construct();
        $this->homeAdminModel = model(\App\Modules\Admin\Models\HomeAdminModel::class);
    }

    public function index()
    {
        $this->login_check();

        $head = [
            'title'       => 'Administration - Styling',
            'description' => '!',
            'keywords'    => '',
        ];

        // Handle POST
        if ($this->request->getPost('newStyle') !== null) {
            $newStyle = $this->request->getPost('newStyle');
            $this->homeAdminModel->setValueStore('newStyle', $newStyle);
            $this->saveHistory('Change site styling');
            return redirect()->to('admin/styling');
        }

        $data = [
            'newStyle' => $this->homeAdminModel->getValueStore('newStyle'),
        ];

        echo view('App\Modules\Admin\Views\settings\styling', array_merge($data, $head));

        $this->saveHistory('Go to Styling page');
    }
}
