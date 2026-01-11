<?php

namespace App\Modules\Admin\Controllers\AdvancedSettings;

use App\Core\AdminController;
use App\Modules\Admin\Models\AdminUsersModel;

class AdminUsers extends AdminController
{
    protected $adminUsersModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminUsersModel = model(\App\Modules\Admin\Models\AdminUsersModel::class);
    }

    public function index($editIdFromRoute = null)
    {
        $this->login_check();

        // Support both: /edit/5 and ?edit=5
        $editId = (int) ($editIdFromRoute ?? $this->request->getGet('edit'));
        $editUser = null;

        if ($editId > 0) {
            $editUser = $this->adminUsersModel->getAdminUsers($editId);
        }

        $head = [
            'title'       => 'Administration - Admin Users',
            'description' => '!',
            'keywords'    => ''
        ];

        $data = [
            'users'     => $this->adminUsersModel->getAdminUsers(),
            'editUser'  => $editUser,                 // for modal prefill
            'openModal' => $editUser !== null,        // auto open modal if edit
            'validation'=> session('validation'),     // show validation after redirect
        ];

        echo view('\App\Modules\Admin\Views\AdvancedSettings\adminUsers', array_merge($data, $head));
        $this->saveHistory('Go to Admin Users');
    }

    public function save()
    {
        $this->login_check();

        // Only accept POST
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to('admin/adminusers');
        }

        $editId = (int) ($this->request->getPost('id') ?? 0);

        // Validation rules (CI4)
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'email'    => 'required|valid_email',
            'notify'   => 'permit_empty|in_list[0,1]',
        ];

        // password required only when creating
        if ($editId === 0) {
            $rules['password'] = 'required|min_length[6]';
        } else {
            $rules['password'] = 'permit_empty|min_length[6]';
        }

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        $post = $this->request->getPost();

        // Ensure strings (avoid null -> trim issues)
        $post['username'] = (string) ($post['username'] ?? '');
        $post['email']    = (string) ($post['email'] ?? '');
        $post['notify']   = (string) ($post['notify'] ?? '0');
        $post['password'] = (string) ($post['password'] ?? '');

        $this->adminUsersModel->setAdminUser($post, $editId);

        $this->saveHistory(($editId > 0 ? 'Update' : 'Create') . ' admin user - ' . $post['username']);

        session()->setFlashdata('result_add', $editId > 0 ? 'User updated!' : 'User created!');
        return redirect()->to('admin/adminusers');
    }

    public function delete(int $id)
    {
        $this->login_check();

        $this->adminUsersModel->deleteAdminUser($id);

        session()->setFlashdata('result_delete', 'User is deleted!');
        $this->saveHistory('Delete admin user - ' . $id);

        return redirect()->to('admin/adminusers');
    }
}
