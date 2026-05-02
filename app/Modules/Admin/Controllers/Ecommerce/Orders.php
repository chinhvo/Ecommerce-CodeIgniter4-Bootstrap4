<?php

namespace App\Modules\Admin\Controllers\Ecommerce;

use App\Core\AdminController;
/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */

class Orders extends AdminController
{
    private $num_rows = 10;
    private $segment = 3;
    private \App\Libraries\SendMail $sendMail;
    private \App\Modules\Admin\Models\OrdersModel $ordersModel;
    private \App\Modules\Admin\Models\HomeAdminModel $homeAdminModel;

    public function __construct()
    {
        parent::__construct();

        // Load library
        $this->sendMail = new \App\Libraries\SendMail();

        // Load models
        $this->ordersModel = model(\App\Modules\Admin\Models\OrdersModel::class);
        $this->homeAdminModel = model(\App\Modules\Admin\Models\HomeAdminModel::class);
    }

    public function index($page = 0)
    {
        $this->login_check();

        helper(['url', 'form', 'pagination']); // load helpers if needed
        $session = session();

        $data = [];
        $head = [
            'title'       => 'Administration - Orders',
            'description' => '!',
            'keywords'    => ''
        ];

        $order_by = $this->request->getGet('order_by');

        $rowscount = $this->ordersModel->ordersCount();
        $data['orders'] = $this->ordersModel->orders($this->num_rows, $page, $order_by);
        $data['links_pagination'] = pagination('admin/orders', $rowscount, $this->num_rows, $page, $this->segment);

        if ($this->request->getPost('paypal_sandbox') !== null) {
            $sandbox = $this->request->getPost('paypal_sandbox');
            $this->homeAdminModel->setValueStore('paypal_sandbox', $sandbox);
            $msg = ($sandbox == 1) ? 'Paypal sandbox mode activated' : 'Paypal sandbox mode disabled';
            $session->setFlashdata('paypal_sandbox', $msg);
            $this->saveHistory($msg);
            return redirect()->to('admin/orders?settings=true');
        }

        if ($this->request->getPost('paypal_email') !== null) {
            $paypalEmail = $this->request->getPost('paypal_email');
            $this->homeAdminModel->setValueStore('paypal_email', $paypalEmail);
            $session->setFlashdata('paypal_email', 'Public quantity visibility changed');
            $this->saveHistory('Change paypal business email to: ' . $paypalEmail);
            return redirect()->to('admin/orders?settings=true');
        }

        if ($this->request->getPost('cashondelivery_visibility') !== null) {
            $codVisibility = $this->request->getPost('cashondelivery_visibility');
            $this->homeAdminModel->setValueStore('cashondelivery_visibility', $codVisibility);
            $session->setFlashdata('cashondelivery_visibility', 'Cash On Delivery Visibility Changed');
            $this->saveHistory('Change Cash On Delivery Visibility - ' . $codVisibility);
            return redirect()->to('admin/orders?settings=true');
        }

        if ($this->request->getPost('iban') !== null) {
            $this->ordersModel->setBankAccountSettings($this->request->getPost());
            $session->setFlashdata('bank_account', 'Bank account settings saved');
            $this->saveHistory('Bank account settings saved for : ' . $this->request->getPost('name'));
            return redirect()->to('admin/orders?settings=true');
        }

        $data['paypal_sandbox'] = $this->homeAdminModel->getValueStore('paypal_sandbox');
        $data['paypal_email']   = $this->homeAdminModel->getValueStore('paypal_email');
        $data['shippingAmount'] = $this->homeAdminModel->getValueStore('shippingAmount');
        $data['shippingOrder']  = $this->homeAdminModel->getValueStore('shippingOrder');
        $data['cashondelivery_visibility'] = $this->homeAdminModel->getValueStore('cashondelivery_visibility');
        $data['bank_account'] = $this->ordersModel->getBankAccountSettings();

        echo view('App\Modules\Admin\Views\ecommerce\orders', array_merge($data, $head));


        if ($page == 0) {
            $this->saveHistory('Go to orders page');
        }
    }

    public function deleteOrder($id)
    {
        $id = (int) $id;

        if ($id === 0) {
            return redirect()->to('admin/orders');
        }

        $this->ordersModel->deleteOrder($id);

        return redirect()->to('admin/orders');
    }

    public function changeOrdersOrderStatus()
    {
        $this->login_check();

        $request = service('request'); // CI4 request instance

        $result = false;
        $sendedVirtualProducts = true;

        $virtualProducts = $this->homeAdminModel->getValueStore('virtualProducts');

        // If we want to use Virtual Products, send them when status is set to 1
        if ($virtualProducts == 1 && $request->getPost('to_status') == 1) {
            $sendedVirtualProducts = $this->sendVirtualProducts();
        }

        if ($sendedVirtualProducts === true) {
            $result = $this->ordersModel->changeOrderStatus(
                $request->getPost('the_id'),
                $request->getPost('to_status')
            );
        }

        echo ($result && $sendedVirtualProducts) ? 1 : 0;

        $this->saveHistory(
            'Change status of Order Id ' . $request->getPost('the_id') .
                ' to status ' . $request->getPost('to_status')
        );
    }

    private function sendVirtualProducts(): bool
    {
        $productsData = $this->request->getPost('products');

        if (empty($productsData)) {
            log_message('error', 'No product data found for virtual products email.');
            return false;
        }

        // SAFER: Prefer JSON over PHP serialize
        $products = @unserialize(html_entity_decode($productsData));
        if (!is_array($products)) {
            log_message('error', 'Invalid product data format.');
            return false;
        }

        foreach ($products as $product_id => $product_quantity) {
            // Replace with your actual product fetch method
            $productInfo = $this->getProductInfo($product_id);

            if (!empty($productInfo['virtual_products'])) {
                $userEmail = $this->request->getPost('userEmail');

                if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                    log_message('error', 'Invalid customer email address. Cannot send virtual products.');
                    return false;
                }

                $email = service('email');
                $email->setFrom('no-reply@example.com', 'Dear Customer');
                $email->setTo($userEmail);
                $email->setSubject('Virtual products');
                $email->setMessage($productInfo['virtual_products']);

                if (!$email->send()) {
                    log_message('error', 'Failed to send virtual product email to ' . $userEmail);
                    return false;
                }

                return true; // sent successfully
            }
        }

        return true; // no virtual products found, but function succeeds
    }
}
