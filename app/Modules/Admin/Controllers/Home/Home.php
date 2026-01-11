<?php
namespace App\Modules\Admin\Controllers\Home;

use App\Core\AdminController;

class Home extends AdminController
{
    protected $Orders_model;
    protected $History_model;
    protected $Home_admin_model;
    protected $session;

    public function __construct()
    {       
        parent::__construct();
        $this->Orders_model      = model(\App\Modules\Admin\Models\OrdersModel::class);
        $this->History_model     = model(\App\Modules\Admin\Models\HistoryModel::class);
        $this->Home_admin_model  = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->session           = session();
    }

    public function index()
    {
        $this->login_check();

        $head = [
            'title'       => 'Administration - Home',
            'description' => '',
            'keywords'    => ''
        ];

        $data = [
            'newOrdersCount'       => $this->Orders_model->ordersCount(true),
            'lowQuantity'          => $this->Home_admin_model->countLowQuantityProducts(),
            'lastSubscribed'       => $this->Home_admin_model->lastSubscribedEmailsCount(),
            'activity'             => $this->History_model->getHistory(10, 0),
            'mostSold'             => $this->Home_admin_model->getMostSoldProducts(),
            'byReferral'           => $this->Home_admin_model->getReferralOrders(),
            'ordersByPaymentType'  => $this->Home_admin_model->getOrdersByPaymentType(),
            'ordersByMonth'        => $this->Home_admin_model->getOrdersByMonth()
        ];

        echo view('\App\Modules\Admin\Views\Home\home', array_merge($head, $data));
        $this->saveHistory('Go to home page');
    }

    /**
     * Called from AJAX
     */
    public function changePass()
    {
        $this->login_check();

        $newPass = $this->request->getPost('new_pass');
        $result  = $this->Home_admin_model->changePass($newPass, $this->username);

        echo $result === true ? 1 : 0;

        $this->saveHistory('Password change for user: ' . $this->username);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('admin');
    }
}