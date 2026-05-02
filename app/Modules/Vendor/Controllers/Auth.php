<?php
namespace App\Modules\Vendor\Controllers;

use App\Core\VendorController;
use App\Modules\Vendor\Models\AuthModel;
use App\Modules\Vendor\Models\VendorprofileModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Auth extends VendorController
{
    private array $registerErrors = [];

    public function __construct()
    {
        parent::__construct();
        $this->authModel = new AuthModel();
        $this->vendorProfileModel = new VendorprofileModel();
        helper(['url', 'form']);
        $this->session = service('session');
    }

    public function index()
    {
        throw PageNotFoundException::forPageNotFound();
    }

    public function login()
    {
        $head = [
            'title'       => lang('user_login_page'),
            'description' => lang('open_your_account'),
            'keywords'    => '',
        ];

        if ($this->request->getPost('login')) {
            $result = $this->verifyVendorLogin();
            if (! $result) {
                $this->session->setFlashdata('login_error', lang('login_vendor_error'));
                return redirect()->to(base_url(LANG_URL . '/vendor/login'));
            }

            $rememberMe = (bool) $this->request->getPost('remember_me');
            $this->setLoginSession($this->request->getPost('u_email'), $rememberMe);
            return redirect()->to(base_url(LANG_URL . '/vendor/me'));
        }

        echo view('_parts/header_auth', $head)
            . view('auth/login')
            . view('_parts/footer_auth');
    }

    private function verifyVendorLogin(): bool
    {
        return $this->authModel->checkVendorExsists($this->request->getPost());
    }

    public function register()
    {
        $head = [
            'title'       => lang('user_register_page'),
            'description' => lang('create_account'),
            'keywords'    => '',
        ];

        if ($this->request->getPost('register')) {
            if (! $this->registerVendor()) {
                $this->session->setFlashdata('error_register', $this->registerErrors);
                $this->session->setFlashdata('email', $this->request->getPost('u_email'));
                return redirect()->to(base_url(LANG_URL . '/vendor/register'));
            }

            $this->setLoginSession($this->request->getPost('u_email'), false);
            return redirect()->to(base_url(LANG_URL . '/vendor/me'));
        }

        echo view('_parts/header_auth', $head)
            . view('auth/register')
            . view('_parts/footer_auth');
    }

    private function registerVendor(): bool
    {
        $errors = [];

        $password       = trim($this->request->getPost('u_password'));
        $passwordRepeat = trim($this->request->getPost('u_password_repeat'));
        $email          = $this->request->getPost('u_email');

        if (mb_strlen($password) === 0) {
            $errors[] = lang('please_enter_password');
        }
        if (mb_strlen($passwordRepeat) === 0) {
            $errors[] = lang('please_repeat_password');
        }
        if ($password !== $passwordRepeat) {
            $errors[] = lang('passwords_dont_match');
        }
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('vendor_invalid_email');
        }

        $countEmails = $this->authModel->countVendorsWithEmail($email);
        if ($countEmails > 0) {
            $errors[] = lang('vendor_email_is_taken');
        }

        if (! empty($errors)) {
            $this->registerErrors = $errors;
            return false;
        }

        $this->authModel->registerVendor($this->request->getPost());
        return true;
    }

    public function forgotten()
    {
        if ($email = $this->request->getPost('u_email')) {
            $vendor = $this->vendorProfileModel->getVendorInfoFromEmail($email);
            if ($vendor) {
                $myDomain = base_url();
                $newPass  = $this->authModel->updateVendorPassword($email);

                service('email')
                    ->setTo($email)
                    ->setFrom('admin@' . parse_url($myDomain, PHP_URL_HOST), 'Admin')
                    ->setSubject('New password for ' . $myDomain)
                    ->setMessage('Hello, your new password is ' . $newPass)
                    ->send();

                $this->session->setFlashdata('login_error', lang('new_pass_sended'));
                return redirect()->to(base_url(LANG_URL . '/vendor/login'));
            }
        }

        $head = [
            'title'       => lang('user_forgotten_page'),
            'description' => lang('recover_password'),
            'keywords'    => '',
        ];

        echo view('_parts/header_auth', $head)
            . view('auth/recover_pass')
            . view('_parts/footer_auth');
    }
}