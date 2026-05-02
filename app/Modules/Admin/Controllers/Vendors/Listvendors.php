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
        $vendors = $this->vendorsModel->getVendors($id);
        $vendorSalesCounts = [];

        foreach ($vendors as $vendor) {
            $countSales = 0;
            $orders = $this->vendorsModel->getVendorOrders((int) $vendor['id']);

            foreach ($orders as $order) {
                $product = unserialize($order['products']);

                if (! is_array($product)) {
                    continue;
                }

                foreach ($product as $value) {
                    $countSales += (int) $value;
                }
            }

            $vendorSalesCounts[(int) $vendor['id']] = $countSales;
        }

        $data = [
            'vendors'           => $vendors,
            'vendorSalesCounts' => $vendorSalesCounts,
        ];


        echo view('App\Modules\Admin\Views\vendors\listvendors', array_merge($data, $head));

        $this->saveHistory('Go to Admin Vendors List');
    }
}
