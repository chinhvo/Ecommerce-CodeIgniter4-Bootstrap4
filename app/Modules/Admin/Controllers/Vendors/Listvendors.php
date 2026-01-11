<?php
namespace App\Modules\Admin\Controllers\Vendors;

use App\Core\AdminController;

class Listvendors extends AdminController
{
    protected $vendorsModel;

    public function __construct()
    {
        parent::__construct();
        $this->vendorsModel = model(\App\Modules\Admin\Models\VendorsModel::class);
    }

    public function index()
    {
        $this->login_check();

        $head = [
            'title'       => 'Administration - Admin Vendors',
            'description' => '!',
            'keywords'    => '',
        ];

        $id = $this->request->getGet('id');

        $data = [
            'vendors'    => $this->vendorsModel->getVendors($id),
            'controller' => $this,
        ];


        echo view('\App\Modules\Admin\Views\Vendors\listVendors', array_merge($data, $head));
        
        $this->saveHistory('Go to Admin Vendors List');
    }

    public function getVendorOrders($id)
    {
        return $this->vendorsModel->getVendorOrders($id);
    }
}