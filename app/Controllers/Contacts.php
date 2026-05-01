<?php


namespace App\Controllers;

use App\Core\MyController;



class Contacts extends MyController
{
    protected $Public_model;
    protected $Home_admin_model;
    protected $contactMessagesModel;
    protected $email;

    public function __construct()
    {
        parent::__construct();
        $this->Public_model = model(\App\Models\PublicModel::class);
        $this->Home_admin_model = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->contactMessagesModel = model(\App\Models\ContactMessagesModel::class);
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

            $messages = [
                'name'    => ['required'    => lang('contact_name_required')],
                'email'   => [
                    'required'    => lang('contact_email_required'),
                    'valid_email' => lang('contact_email_invalid')
                ],
                'subject' => ['required'    => lang('contact_subject_required')],
                'message' => ['required'    => lang('contact_message_required')],
            ];

            if (!$this->validate($rules, $messages)) {
                return redirect()->to(site_url('contacts'))->withInput()->with('errors', $this->validator->getErrors());
            }

            $this->contactMessagesModel->saveMessage([
                'name'       => (string) $this->request->getPost('name'),
                'email'      => (string) $this->request->getPost('email'),
                'subject'    => (string) $this->request->getPost('subject'),
                'message'    => (string) $this->request->getPost('message'),
                'ip_address' => $this->request->getIPAddress(),
                'user_agent' => $this->request->getUserAgent()->getAgentString(),
            ]);

            $result = $this->sendEmail();
            if ($result) {
                $this->session->setFlashdata('resultSend', lang('contact_sent_success'));
            } else {
                $this->session->setFlashdata('resultSend', lang('contact_sent_error'));
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
            $this->email->setFrom($email, $name);
            $this->email->setTo($myEmail);
            $this->email->setSubject($subject);
            $this->email->setMessage($message);

            $this->email->send();
            return true;
        }
        return false;
    }
}
