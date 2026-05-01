<?php

namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;

class ContactMessages extends AdminController
{
    private int $numRows = 20;
    protected $contactMessagesModel;
    protected $session;

    public function __construct()
    {
        parent::__construct();

        $this->contactMessagesModel = model(\App\Models\ContactMessagesModel::class);
        $this->session = session();
    }

    public function index($page = 0)
    {
        $this->login_check();

        if ($this->request->getGet('delete')) {
            $this->contactMessagesModel->deleteMessage((int) $this->request->getGet('delete'));
            $this->session->setFlashdata('contactMessageDeleted', lang('contact_messages_deleted'));

            return redirect()->to('admin/contact-messages');
        }

        $head = [
            'title'       => 'Administration - Contact Messages',
            'description' => '',
            'keywords'    => '',
        ];

        $rowsCount = $this->contactMessagesModel->messagesCount();

        $data = [
            'links_pagination' => pagination('admin/contact-messages', $rowsCount, $this->numRows, 3),
            'messages'         => $this->contactMessagesModel->getMessages($this->numRows, (int) $page),
        ];

        echo view('\App\Modules\Admin\Views\Settings\contact_messages', array_merge($data, $head));

        if ((int) $page === 0) {
            $this->saveHistory('Go to Contact Messages');
        }
    }
}
