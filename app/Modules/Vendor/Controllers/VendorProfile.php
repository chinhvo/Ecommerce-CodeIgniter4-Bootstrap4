<?php
namespace App\Modules\Vendor\Controllers;

use App\Core\VendorController;
use App\Modules\Vendor\Models\VendorProfileModel;

class VendorProfile extends VendorController
{
    protected VendorProfileModel $vendorProfileModel;

    public function __construct()
    {
        parent::__construct();
        
        helper(['url', 'cookie']);
        session();

        $this->vendorProfileModel = new VendorProfileModel();
    }

    public function index()
    {
        $head = [
            'title'       => lang('vendor_dashboard'),
            'description' => lang('vendor_home_page'),
            'keywords'    => '',
        ];

        $data = [
            'ordersByMonth' => $this->vendorProfileModel->getOrdersByMonth($this->vendor_id),
        ];

        echo view('_parts/header', $head)
            . view('home', $data)
            . view('_parts/footer');
    }

    public function logout()
    {
        session()->remove('logged_vendor');
        delete_cookie('logged_vendor');
        return redirect()->to(LANG_URL . '/vendor/login');
    }
}