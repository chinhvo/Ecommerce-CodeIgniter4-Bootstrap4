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

        // Handle POST submission
        $template = $this->request->getPost('template');
        if ($template !== null) {
            $this->homeAdminModel->setValueStore('template', $template);
            return redirect()->to('admin/templates');
        }

        // Get available templates
        $data['templates'] = [];
        $path = TEMPLATES_DIR;
        $templates_dirs = array_filter(scandir($path), function($item) use ($path) {
            return $item[0] !== '.' && is_dir(TEMPLATES_DIR . DIRECTORY_SEPARATOR . $item);
        });            
        foreach ($templates_dirs as $template) {
            if ($template !== "." && $template !== "..") {
                $data['templates'][] = $template;
            }
        }

        // Get selected template
        $data['seleced_template'] = $this->homeAdminModel->getValueStore('template');

        // Render views
        echo view('\App\Modules\Admin\Views\settings\templates', array_merge($data, $head));        

        $this->saveHistory('Go to Templates Page');
    }
}