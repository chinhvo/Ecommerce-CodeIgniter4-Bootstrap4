<?php
namespace App\Modules\Vendor\Controllers;

use App\Core\VendorController;
use App\Modules\Vendor\Models\OrdersModel;
use App\Modules\Vendor\Models\ProductsModel;

class Orders extends VendorController
{
    private int $num_rows = 20;

    protected OrdersModel $ordersModel;
    protected ProductsModel $productsModel;

    public function __construct()
    {
        parent::__construct();

        $this->ordersModel   = new OrdersModel();
        $this->productsModel = new ProductsModel();

        helper(['url', 'form']);
    }

    public function index(int $page = 0)
    {
        $head = [
            'title'       => lang('vendor_orders'),
            'description' => lang('vendor_orders'),
            'keywords'    => '',
        ];

        $data['orders'] = $this->ordersModel->orders($this->num_rows, $page, $this->vendor_id);

        echo view('_parts/header', $head)
            . view('orders', $data)
            . view('_parts/footer');
    }

    public function getProductInfo(int $product_id, int $vendor_id)
    {
        return $this->productsModel->getOneProduct($product_id, $vendor_id);
    }

    public function changeOrdersOrderStatus()
    {
        $id       = $this->request->getPost('the_id');
        $toStatus = $this->request->getPost('to_status');

        $result = $this->ordersModel->changeOrderStatus($id, $toStatus);

        return $this->response->setBody($result ? '1' : '0');
    }
}