<?php

namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;

class Emails extends AdminController
{
    private $num_rows = 20;
    protected $Emails_model;
    protected $session;

    public function __construct()
    {
        parent::__construct();

        $this->Emails_model = model(\App\Modules\Admin\Models\EmailsModel::class);
        $this->session      = session();
    }

    public function index($page = 0)
    {
        $this->login_check();

        // Export emails
        if ($this->request->getPost('export')) {
            $rowscount  = $this->Emails_model->emailsCount();
            $all_emails = $this->Emails_model->getSubscribedEmails(0, 0);

            header("Content-Type: text/plain");
            header("Content-Disposition: attachment; filename=online-shop-$rowscount-emails-export.txt");

            foreach ($all_emails as $row) {
                echo $row->email . "\n";
            }
            exit;
        }

        // Delete email
        if ($this->request->getGet('delete')) {
            $this->Emails_model->deleteEmail($this->request->getGet('delete'));
            $this->session->setFlashdata('emailDeleted', 'Email address is deleted!');
            return redirect()->to('admin/emails');
        }

        // Prepare data
        $head = [
            'title'       => 'Administration - Subscribed Emails',
            'description' => '!',
            'keywords'    => ''
        ];

        $rowscount = $this->Emails_model->emailsCount();

        $data = [
            'links_pagination' => pagination('admin/emails', $rowscount, $this->num_rows, 3),
            'emails'           => $this->Emails_model->getSubscribedEmails($this->num_rows, $page)
        ];

        echo view('App\Modules\Admin\Views\settings\emails', array_merge($data, $head));


        if ($page == 0) {
            $this->saveHistory('Go to Subscribed Emails');
        }
    }
}
