<?php
namespace App\Modules\Admin\Controllers\Ecommerce;

use App\Core\AdminController;

class Brands extends AdminController
{
    protected $Brands_model;

    public function __construct()
    {
        parent::__construct();
        $this->Brands_model = model(\App\Modules\Admin\Models\BrandsModel::class);
    }

    public function index()
    {
        $this->login_check();

        // Handle brand creation
        if ($this->request->getPost('name')) {
            $this->Brands_model->setBrand($this->request->getPost('name'));
            return redirect()->to('admin/brands');
        }

        // Handle brand deletion
        if ($this->request->getGet('delete')) {
            $this->Brands_model->deleteBrand($this->request->getGet('delete'));
            return redirect()->to('admin/brands');
        }

        $head = [
            'title'       => 'Administration - Brands',
            'description' => '!',
            'keywords'    => ''
        ];

        $data = [
            'brands' => $this->Brands_model->getBrands()
        ];

        echo view('_parts/header', $head);
        echo view('ecommerce/brands', $data);
        echo view('_parts/footer');

        $this->saveHistory('Go to brands page');
    }
}
