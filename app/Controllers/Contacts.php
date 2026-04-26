<?php


namespace App\Controllers;
use App\Core\MyController;



class Contacts extends MyController
{
    protected $Public_model;
    protected $Home_admin_model;
    protected $email;

    public function __construct()
    {
        parent::__construct();
        $this->Public_model = model(\App\Models\PublicModel::class);
        $this->Home_admin_model = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->email = service('email');
    }

    public function index()
    {
        $head = array();
        $data = array();
        if (isset($_POST['message'])) {
            $result = $this->sendEmail();
            if ($result) {
                $this->session->setFlashdata('resultSend', 'Email is sened!');
            } else {
                $this->session->setFlashdata('resultSend', 'Email send error!');
            }
            redirect('contacts');
        }
        $data['googleMaps'] = $this->Home_admin_model->getValueStore('googleMaps');
        $data['googleApi'] = $this->Home_admin_model->getValueStore('googleApi');
        $arrSeo = $this->Public_model->getSeo('contacts');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
        $this->render('contacts', $head, $data);
    }

    private function sendEmail()
    {
        $myEmail = $this->Home_admin_model->getValueStore('contactsEmailTo');
        if (filter_var($myEmail, FILTER_VALIDATE_EMAIL) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->email->from($_POST['email'], $_POST['name']);
            $this->email->to($myEmail);

            $this->email->subject($_POST['subject']);
            $this->email->message($_POST['message']);

            $this->email->send();
            return true;
        }
        return false;
    }

}
