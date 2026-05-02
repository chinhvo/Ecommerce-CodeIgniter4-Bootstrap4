<?php

namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;

class Templates extends AdminController
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
            'title'       => 'Administration - Templates',
            'description' => '!',
            'keywords'    => '',
        ];

        // Template switching is no longer supported.
        // The site uses a single fixed template (clothesshop) located in app/Views/.
        $data['templates'] = [];
        $data['seleced_template'] = null;

        // Render views
        echo view('App\Modules\Admin\Views\settings\templates', array_merge($data, $head));

        $this->saveHistory('Go to Templates Page');
    }
}
