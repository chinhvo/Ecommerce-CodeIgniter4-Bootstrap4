<?php

namespace App\Modules\Admin\Controllers\Ecommerce;

use App\Core\AdminController;

class Discounts extends AdminController
{
    private $num_rows = 10;
    protected $Discounts_model;
    protected $Home_admin_model;
    protected $session;

    public function __construct()
    {
        parent::__construct();

        $this->Discounts_model = model(\App\Modules\Admin\Models\DiscountsModel::class);
        $this->Home_admin_model = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->session = session();
    }

    public function index($page = 0)
    {
        $this->login_check();

        // Add new or update discount
        if ($this->request->getPost('code')) {
            $this->setDiscountCode();
        }

        // Restore previous POST data after validation error
        if ($this->session->getFlashdata('POST')) {
            $_POST = $this->session->getFlashdata('POST');
        }

        // Edit discount
        if ($this->request->getGet('edit')) {
            $_POST = $this->Discounts_model->getDiscountCodeInfo($this->request->getGet('edit'));
            if (empty($_POST)) {
                return redirect()->to('admin/discounts');
            }
            $_POST['valid_from_date'] = date('d.m.Y', $_POST['valid_from_date']);
            $_POST['valid_to_date']   = date('d.m.Y', $_POST['valid_to_date']);
            $_POST['update']          = $_POST['id'];
        }

        // Change discount status
        if (null !== $this->request->getGet('tostatus') && $this->request->getGet('codeid')) {
            $this->Discounts_model->changeCodeDiscountStatus(
                $this->request->getGet('codeid'),
                $this->request->getGet('tostatus')
            );
            return redirect()->to('admin/discounts');
        }

        // Toggle global discount setting
        if (null !== $this->request->getPost('codeDiscounts')) {
            $this->Home_admin_model->setValueStore('codeDiscounts', $this->request->getPost('codeDiscounts'));
            return redirect()->to('admin/discounts');
        }

        $head = [
            'title'       => 'Administration - Discounts',
            'description' => '!',
            'keywords'    => ''
        ];

        $data = [
            'codeDiscounts'     => $this->Home_admin_model->getValueStore('codeDiscounts'),
            'discountCodes'     => $this->Discounts_model->getDiscountCodes($this->num_rows, $page),
            'links_pagination'  => pagination('admin/discounts', $this->Discounts_model->discountCodesCount(), $this->num_rows, 3)
        ];

        echo view('App\Modules\Admin\Views\ecommerce\discounts', array_merge($data, $head));

        if ($page == 0) {
            $this->saveHistory('Go to discounts page');
        }
    }

    private function setDiscountCode()
    {
        $isValid = $this->validateCode();
        if ($isValid === true) {
            if ((int)$this->request->getPost('update') === 0) {
                $this->Discounts_model->setDiscountCode($this->request->getPost());
            } else {
                $this->Discounts_model->updateDiscountCode($this->request->getPost());
            }
            $this->session->setFlashdata('success', 'Changes are saved');
        } else {
            $this->session->setFlashdata('error', $isValid);
            $this->session->setFlashdata('POST', $this->request->getPost());
        }

        return redirect()->to('admin/discounts');
    }

    private function validateCode()
    {
        $errors = [];

        $type = $this->request->getPost('type');
        $amount = (float)$this->request->getPost('amount');
        $code = trim($this->request->getPost('code'));
        $validFrom = $this->request->getPost('valid_from_date');
        $validTo = $this->request->getPost('valid_to_date');

        if ($type !== 'percent' && $type !== 'float') {
            $errors[] = 'Type of discount is not valid!';
        }
        if ($amount == 0) {
            $errors[] = 'Discount amount is 0!';
        }
        if (mb_strlen($code) < 3) {
            $errors[] = 'Discount code is lower than 3 symbols!';
        } else {
            if ($this->Discounts_model->discountCodeTakenCheck($this->request->getPost()) === false) {
                $errors[] = 'Discount code taken!';
            }
        }
        if (strtotime($validFrom) === false) {
            $errors[] = 'From date is invalid!';
        }
        if (strtotime($validTo) === false) {
            $errors[] = 'To date is invalid!';
        }

        return empty($errors) ? true : $errors;
    }
}
