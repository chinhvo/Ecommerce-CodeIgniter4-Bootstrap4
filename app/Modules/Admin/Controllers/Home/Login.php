<?php
namespace App\Modules\Admin\Controllers\Home;

use App\Core\AdminController;

class Login extends AdminController
{
    protected $Home_admin_model;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->Home_admin_model = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->session          = session();
        $this->validation       = \Config\Services::validation();
    }

    public function index()
    {
        $head = [
            'title'       => 'Administration - Login',
            'description' => '',
            'keywords'    => ''
        ];

        // If already logged in
        if ($this->session->get('logged_in')) {
            return redirect()->to('/admin/home');
        }

        // Handle form submission
        if ($this->request->getMethod() === 'POST') {

            $this->validation->setRules([
                'username' => 'trim|required',
                'password' => 'trim|required'
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $postData = $this->request->getPost();
                $result   = $this->Home_admin_model->loginCheck($postData);

                if (!empty($result)) {
                    $_SESSION['last_login'] = $result['last_login']; // legacy session var

                    $this->session->set('logged_in', $result['username']);
                    $this->session->set('user_id', $result['id']);

                    $this->saveHistory('User ' . $result['username'] . ' logged in');

                    return redirect()->to('admin/home');
                } else {
                    $this->saveHistory(
                        'Cant login with - User: ' . $postData['username'] . 
                        ' and Pass: ' . $postData['password']
                    );

                    $this->session->setFlashdata('err_login', 'Wrong username or password!');
                    return redirect()->to('/');
                }
            }
        }

        // Load login view
        echo view('\App\Modules\Admin\Views\_parts\layout', $head);
    }
}