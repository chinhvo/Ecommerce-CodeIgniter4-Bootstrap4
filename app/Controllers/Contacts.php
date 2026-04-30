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
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name' => 'required',
                'email' => 'required|valid_email',
                'subject' => 'required',
                'message' => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->to(site_url('contacts'))->withInput()->with('errors', $this->validator->getErrors());
            }

            $result = $this->sendEmail();
            if ($result) {
                $this->session->setFlashdata('resultSend', 'Email is sened!');
            } else {
                $this->session->setFlashdata('resultSend', 'Email send error!');
            }
            return redirect()->to(site_url('contacts'));
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
        $email = (string) $this->request->getPost('email');
        $name = (string) $this->request->getPost('name');
        $subject = (string) $this->request->getPost('subject');
        $message = (string) $this->request->getPost('message');

        if (filter_var($myEmail, FILTER_VALIDATE_EMAIL) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email->from($email, $name);
            $this->email->to($myEmail);

            $this->email->subject($subject);
            $this->email->message($message);

            $this->email->send();
            return true;
        }
        return false;
    }
}
