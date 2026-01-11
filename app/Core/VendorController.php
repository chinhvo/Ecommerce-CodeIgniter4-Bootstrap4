<?php
namespace App\Core;
use App\Controllers\BaseController;
/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */

class VendorController extends BaseController
{

    protected $allowed_img_types;
    public $vendor_id;
    public $vendor_name;
    public $vendor_url;

    public function __construct()
    {
        parent::__construct();

        $this->loginCheck();
        $this->setVendorInfo();

        // Load config value
        $this->allowed_img_types = config('App')->allowed_img_types;

        // Pass variables to all views
        $this->vendor_name = $this->vendor_name ?? '';
        $this->vendor_url  = $this->vendor_url ?? '';
        $this->viewData = [
            'vendor_name' => $this->vendor_name,
            'vendor_url'  => $this->vendor_url
        ];

        // Handle vendor details save
        if ($this->request->getPost('saveVendorDetails')) {
            $this->saveNewVendorDetails();
        }
    }

    protected function loginCheck()
    {
        // Restore session from cookie if missing
        if (!$this->session->has('logged_vendor') && $this->request->getCookie('logged_vendor') !== null) {
            $this->session->set('logged_vendor', $this->request->getCookie('logged_vendor'));
        }

        $authPages = [
            'vendor/login',
            'vendor/register',
            'vendor/forgotten-password'
        ];

        // Get URI as string without locale prefix
        $urlString = uri_string();
        if (preg_match('/^[a-zA-Z]{2}\//', $urlString)) {
            $urlString = preg_replace('/^[a-zA-Z]{2}\//', '', $urlString);
        }

        // Redirect logic
        if (!$this->session->has('logged_vendor') && !in_array($urlString, $authPages)) {
            return redirect()->to(LANG_URL . '/vendor/login');
        } elseif ($this->session->has('logged_vendor') && in_array($urlString, $authPages)) {
            return redirect()->to(LANG_URL . '/vendor/me');
        }
    }

    protected function setLoginSession($email, $remember_me)
    {
        $response = service('response');

        if ($remember_me === true) {
            // 2678400 seconds = 31 days
            $response->setCookie('logged_vendor', $email, 2678400);
        }

        $this->session->set('logged_vendor', $email);
    }

    private function setVendorInfo()
    {
        $vendorProfileModel = model('App\Models\Vendor\VendorProfileModel');

        if ($this->session->has('logged_vendor')) {
            $array = $vendorProfileModel->getVendorInfoFromEmail($this->session->get('logged_vendor'));

            $this->vendor_id   = $array['id'] ?? null;
            $this->vendor_name = $array['name'] ?? null;
            $this->vendor_url  = $array['url'] ?? null;
        }
    }

    private function saveNewVendorDetails()
    {
        $errors = [];

        $vendorName = trim($this->request->getPost('vendor_name'));
        $vendorUrl  = trim($this->request->getPost('vendor_url'));

        // Validate inputs
        if (mb_strlen($vendorName) === 0) {
            $errors[] = lang('enter_vendor_name');
        }
        if (mb_strlen($vendorUrl) === 0) {
            $errors[] = lang('enter_vendor_url');
        }

        $vendorProfileModel = model('App\Models\VendorprofileModel');
        if (!$vendorProfileModel->isVendorUrlFree($vendorUrl)) {
            $errors[] = lang('vendor_url_taken');
        }

        // Process result
        if (empty($errors)) {
            $this->session->setFlashdata('update_vend_details', lang('vendor_details_updated'));
            $vendorProfileModel->saveNewVendorDetails($this->request->getPost(), $this->vendor_id);
        } else {
            $this->session->setFlashdata('update_vend_err', $errors);
        }

        return redirect()->to(LANG_URL . '/vendor/me');
    }

}
