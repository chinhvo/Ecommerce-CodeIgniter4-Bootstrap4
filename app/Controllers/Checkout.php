<?php




namespace App\Controllers;

use App\Core\MyController;

class Checkout extends MyController
{
    protected $Public_model;
    protected $Orders_model;
    protected $Home_admin_model;

    private $orderId;

    public function __construct()
    {
        parent::__construct();
        $this->Public_model = model(\App\Models\PublicModel::class);
        $this->Orders_model = model(\App\Modules\Admin\Models\OrdersModel::class);
        $this->Home_admin_model = model(\App\Modules\Admin\Models\HomeAdminModel::class);
    }

    public function index()
    {
        if (isRequestMethod($this->request, 'post')) {
            return $this->submitOrder();
        }
        return $this->showCheckoutPage();
    }

    private function showCheckoutPage()
    {
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('checkout');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';

        $data['bank_account'] = $this->Orders_model->getBankAccountSettings();
        $data['cashondelivery_visibility'] = $this->Home_admin_model->getValueStore('cashondelivery_visibility');
        $data['paypal_email'] = $this->Home_admin_model->getValueStore('paypal_email');
        $data['shippingAmount'] = $this->Home_admin_model->getValueStore('shippingAmount');
        $data['bestSellers'] = $this->Public_model->getbestSellers();
        $this->render('checkout', $head, $data);
    }

    private function submitOrder()
    {
        $post = $this->request->getPost();
        if (empty($post['payment_type'])) {
            $post['payment_type'] = 'cashOnDelivery';
        }
        $errors = $this->userInfoValidate($post);

        if (!empty($errors)) {
            $this->session->setFlashdata('submit_error', $errors);
            return $this->showCheckoutPage();
        }

        $post['referrer'] = (string) ($this->session->get('referrer') ?? '');
        $post['clean_referrer'] = cleanReferral($post['referrer']);
        $post['user_id'] = isset($_SESSION['logged_user']) ? $_SESSION['logged_user'] : 0;

        $orderId = $this->Public_model->setOrder($post);
        if ($orderId != false) {
            /*
             * Save product orders in vendors profiles
             */
            $this->setVendorOrders($post);
            $this->orderId = $orderId;
            $this->setActivationLink($post);
            $this->sendNotifications();
            return $this->goToDestination($post);
        }

        log_message('error', 'Cant save order!! ' . implode('::', $post));
        $this->session->setFlashdata('order_error', true);
        return redirect()->to(LANG_URL . '/checkout/order-error');
    }

    private function setVendorOrders($post)
    {
        $this->Public_model->setVendorOrder($post);
    }

    /*
     * Send notifications to users that have nofify=1 in /admin/adminusers
     */

    private function sendNotifications()
    {
        $users = $this->Public_model->getNotifyUsers();
        $myDomain = base_url();
        if (!empty($users)) {
            $this->sendmail->clearAddresses();
            foreach ($users as $user) {
                $this->sendmail->sendTo($user, 'Admin', 'New order in ' . $myDomain, 'Hello, you have new order. Can check it in /admin/orders');
            }
        }
    }

    private function setActivationLink($post)
    {
        if (config('App')->send_confirm_link === true) {
            $link = md5($this->orderId . time());
            $result = $this->Public_model->setActivationLink($link, $this->orderId);
            if ($result == true) {
                $url = parse_url(base_url());
                $msg = lang('please_confirm') . base_url('confirm/' . $link);
                $this->sendmail->sendTo($post['email'], $post['first_name'] . ' ' . $post['last_name'], lang('confirm_order_subj') . $url['host'], $msg);
            }
        }
    }

    private function goToDestination($post)
    {
        if ($post['payment_type'] == 'cashOnDelivery' || $post['payment_type'] == 'Bank') {
            $this->shoppingcart->clearShoppingCart();
            $this->session->setFlashdata('success_order', true);
        }
        if ($post['payment_type'] == 'Bank') {
            $_SESSION['order_id'] = $this->orderId;
            $_SESSION['final_amount'] = $post['final_amount'] . $post['amount_currency'];
            return redirect()->to(LANG_URL . '/checkout/successbank');
        }
        if ($post['payment_type'] == 'cashOnDelivery') {
            return redirect()->to(LANG_URL . '/checkout/successcash');
        }
        if ($post['payment_type'] == 'PayPal') {
            @set_cookie('paypal', $this->orderId, 2678400);
            $_SESSION['discountAmount'] = $post['discountAmount'];
            return redirect()->to(LANG_URL . '/checkout/paypalpayment');
        }
    }

    private function userInfoValidate($post)
    {
        $errors = array();
        if (mb_strlen(trim($post['first_name'])) == 0) {
            $errors[] = lang('first_name_empty');
        }
        if (mb_strlen(trim($post['last_name'])) == 0) {
            $errors[] = lang('last_name_empty');
        }
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('invalid_email');
        }
        $post['phone'] = preg_replace("/[^0-9]/", '', $post['phone']);
        if (mb_strlen(trim($post['phone'])) == 0) {
            $errors[] = lang('invalid_phone');
        }
        if (mb_strlen(trim($post['address'])) == 0) {
            $errors[] = lang('address_empty');
        }
        if (mb_strlen(trim($post['city'])) == 0) {
            $errors[] = lang('invalid_city');
        }
        return $errors;
    }

    public function orderError()
    {
        if ($this->session->getFlashdata('order_error')) {
            $data = array();
            $head = array();
            $arrSeo = $this->Public_model->getSeo('checkout');
            $head['title'] = @$arrSeo['title'];
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
            $this->render('checkout_parts/order_error', $head, $data);
        } else {
            return redirect()->to(LANG_URL . '/checkout');
        }
    }

    public function paypalPayment()
    {
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('checkout');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
        $data['paypal_sandbox'] = $this->Home_admin_model->getValueStore('paypal_sandbox');
        $data['paypal_email'] = $this->Home_admin_model->getValueStore('paypal_email');
        $this->render('checkout_parts/paypal_payment', $head, $data);
    }

    public function successPaymentCashOnD()
    {
        if ($this->session->getFlashdata('success_order')) {
            $data = array();
            $head = array();
            $arrSeo = $this->Public_model->getSeo('checkout');
            $head['title'] = @$arrSeo['title'];
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
            $this->render('checkout_parts/payment_success_cash', $head, $data);
        } else {
            return redirect()->to(LANG_URL . '/checkout');
        }
    }

    public function successPaymentBank()
    {
        if ($this->session->getFlashdata('success_order')) {
            $data = array();
            $head = array();
            $arrSeo = $this->Public_model->getSeo('checkout');
            $head['title'] = @$arrSeo['title'];
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
            $data['bank_account'] = $this->Orders_model->getBankAccountSettings();
            $this->render('checkout_parts/payment_success_bank', $head, $data);
        } else {
            return redirect()->to(LANG_URL . '/checkout');
        }
    }

    public function paypal_cancel()
    {
        if (get_cookie('paypal') == null) {
            return redirect()->to(base_url());
        }
        @delete_cookie('paypal');
        $orderId = get_cookie('paypal');
        $this->Public_model->changePaypalOrderStatus($orderId, 'canceled');
        $data = array();
        $head = array();
        $head['title'] = '';
        $head['description'] = '';
        $head['keywords'] = '';
        $this->render('checkout_parts/paypal_cancel', $head, $data);
    }

    public function paypal_success()
    {
        if (get_cookie('paypal') == null) {
            return redirect()->to(base_url());
        }
        @delete_cookie('paypal');
        $this->shoppingcart->clearShoppingCart();
        $orderId = get_cookie('paypal');
        $this->Public_model->changePaypalOrderStatus($orderId, 'payed');
        $data = array();
        $head = array();
        $head['title'] = '';
        $head['description'] = '';
        $head['keywords'] = '';
        $this->render('checkout_parts/paypal_success', $head, $data);
    }
}
