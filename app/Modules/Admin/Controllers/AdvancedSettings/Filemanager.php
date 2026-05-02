<?php

namespace App\Modules\Admin\Controllers\AdvancedSettings;

use App\Core\AdminController;

class Filemanager extends AdminController
{
    public function index()
    {
        $this->login_check();

        $data = [];
        $head = [
            'title'       => 'Administration - File Manager',
            'description' => '!',
            'keywords'    => ''
        ];

        echo view('App\Modules\Admin\Views\advancedsettings\filemanager', array_merge($data, $head));


        $this->saveHistory('Go to File Manager');
    }
}
