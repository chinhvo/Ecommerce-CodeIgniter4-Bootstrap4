<?php
namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;

class Titles extends AdminController
{
    protected $titlesModel;
    protected $languagesModel;

    public function __construct()
    {
        parent::__construct();
        $this->titlesModel    = model(\App\Modules\Admin\Models\TitlesModel::class);
        $this->languagesModel = model(\App\Modules\Admin\Models\LanguagesModel::class);
    }

    public function index()
    {
        $this->login_check();

        $head = [
            'title'       => 'Administration - Titles / Descriptions',
            'description' => '!',
            'keywords'    => '',
        ];

        if ($this->request->getPost('save')) {
            $this->titlesModel->setSeoPageTranslations($this->request->getPost());
            $this->saveHistory('Changed Titles / Descriptions');
            session()->setFlashdata('result_publish', 'Saved successfully!');
            return redirect()->to('admin/titles');
        }

        $data['seo_trans'] = $this->titlesModel->getSeoTranslations();
        $data['languages'] = $this->languagesModel->getLanguages();
        $data['seo_pages'] = $this->titlesModel->getSeoPages();

        echo view('\App\Modules\Admin\Views\settings\titles', array_merge($data, $head));

        $this->saveHistory('Go to Titles / Descriptions page');
    }
}