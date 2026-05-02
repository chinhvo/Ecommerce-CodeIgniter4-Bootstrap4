<?php

namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;
/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */

class Settings extends AdminController
{
    protected $homeAdminModel;
    protected $languagesModel;
    protected $settingsModel;

    public function __construct()
    {
        parent::__construct();
        $this->homeAdminModel = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->languagesModel = model(\App\Modules\Admin\Models\LanguagesModel::class);
        $this->settingsModel = model(\App\Modules\Admin\Models\SettingsModel::class);
    }

    public function index()
    {
        $this->login_check();

        $data = [];
        $head = [
            'title'       => 'Administration - Settings',
            'description' => '',
            'keywords'    => ''
        ];

        $this->postChecker();

        $valueStores = $this->getValueStores();
        if (!is_null($valueStores)) {
            foreach ($valueStores as $value) {
                if (!array_key_exists($value['thekey'], $data)) {
                    $data[$value['thekey']] = $value['value'];
                }
            }
        }

        $data['cookieLawInfo'] = $this->getCookieLaw();
        $data['languages']     = $this->languagesModel->getLanguages();
        $data['law_themes']    = array_diff(
            scandir(FCPATH . 'assets/imgs/cookie-law-themes/'),
            ['..', '.']
        );

        // Merge $head and $data if you need them in one array for views
        echo view('App\Modules\Admin\Views\settings\settings', array_merge($data, $head));

        $this->saveHistory('Go to Settings Page');
    }

    private function getValueStores()
    {
        $values = $this->settingsModel->getValueStores();

        return (!empty($values) && is_array($values)) ? $values : null;
    }

    private function postChecker()
    {
        if ($this->request->getPost('uploadimage') != null) {
            $uploadPath = FCPATH . 'attachments' . DIRECTORY_SEPARATOR . 'site_logo' . DIRECTORY_SEPARATOR;
            $allowedExtensions = ['gif', 'jpg', 'jpeg', 'png'];
            $maxSizeInBytes = 1500 * 1024;
            $maxWidth = 1024;
            $maxHeight = 768;
            $logoFile = $this->request->getFile('sitelogo');

            if ($logoFile === null || !$logoFile->isValid()) {
                $errorMessage = $logoFile !== null ? $logoFile->getErrorString() : 'No file was uploaded.';
                session()->setFlashdata('resultSiteLogoPublish', $errorMessage);
            } else {
                $extension = strtolower((string) $logoFile->getExtension());
                $imageInfo = @getimagesize($logoFile->getTempName());

                if (!in_array($extension, $allowedExtensions, true)) {
                    session()->setFlashdata('resultSiteLogoPublish', lang('settings_logo_invalid_ext'));
                } elseif ($logoFile->getSize() > $maxSizeInBytes) {
                    session()->setFlashdata('resultSiteLogoPublish', lang('settings_logo_too_large'));
                } elseif ($imageInfo === false) {
                    session()->setFlashdata('resultSiteLogoPublish', lang('settings_logo_not_image'));
                } elseif ($imageInfo[0] > $maxWidth || $imageInfo[1] > $maxHeight) {
                    session()->setFlashdata('resultSiteLogoPublish', lang('settings_logo_too_big'));
                } else {
                    $newImage = $logoFile->getRandomName();
                    $logoFile->move($uploadPath, $newImage, true);

                    if (!$logoFile->hasMoved()) {
                        session()->setFlashdata('resultSiteLogoPublish', lang('settings_logo_save_failed'));
                        return redirect()->to(base_url('admin/settings'));
                    }

                    $this->homeAdminModel->setValueStore('sitelogo', $newImage);
                    $this->saveHistory('Change site logo');
                    session()->setFlashdata('resultSiteLogoPublish', lang('settings_logo_success'));
                }
            }
            return redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('naviText') != null) {
            $this->homeAdminModel->setValueStore('navitext', $_POST['naviText']);
            session()->setFlashdata('resultNaviText', lang('settings_navi_text_success'));
            $this->saveHistory('Change navigation text');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('footerCopyright') != null) {
            $this->homeAdminModel->setValueStore('footercopyright', $_POST['footerCopyright']);
            session()->setFlashdata('resultFooterCopyright', lang('settings_footer_copyright_success'));
            $this->saveHistory('Change footer copyright');
            redirect()->to(base_url('admin/settings') != null);
        }
        if ($this->request->getPost('contactsPage') != null) {
            $this->homeAdminModel->setValueStore('contactspage', $_POST['contactsPage']);
            session()->setFlashdata('resultContactspage', lang('settings_contacts_page_success'));
            $this->saveHistory('Change contacts page');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('footerContacts') != null) {
            $this->homeAdminModel->setValueStore('footerContactAddr', $_POST['footerContactAddr']);
            $this->homeAdminModel->setValueStore('footerContactPhone', $_POST['footerContactPhone']);
            $this->homeAdminModel->setValueStore('footerContactEmail', $_POST['footerContactEmail']);
            session()->setFlashdata('resultfooterContacts', lang('settings_footer_contacts_success'));
            $this->saveHistory('Change footer contacts');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('footerSocial') != null) {
            $this->homeAdminModel->setValueStore('footerSocialFacebook', $_POST['footerSocialFacebook']);
            $this->homeAdminModel->setValueStore('footerSocialTwitter', $_POST['footerSocialTwitter']);
            $this->homeAdminModel->setValueStore('footerSocialGooglePlus', $_POST['footerSocialGooglePlus']);
            $this->homeAdminModel->setValueStore('footerSocialPinterest', $_POST['footerSocialPinterest']);
            $this->homeAdminModel->setValueStore('footerSocialYoutube', $_POST['footerSocialYoutube']);
            $this->homeAdminModel->setValueStore('footerSocialZalo', $_POST['footerSocialZalo']);
            session()->setFlashdata('resultfooterSocial', lang('settings_footer_social_success'));
            $this->saveHistory('Change footer contacts');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('googleMaps') != null) {
            $this->homeAdminModel->setValueStore('googleMaps', $_POST['googleMaps']);
            $this->homeAdminModel->setValueStore('googleApi', $_POST['googleApi']);
            session()->setFlashdata('resultGoogleMaps', lang('settings_google_maps_success'));
            $this->saveHistory('Update Google Maps Coordinates and Api Key');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('footerAboutUs') != null) {
            $this->homeAdminModel->setValueStore('footerAboutUs', $_POST['footerAboutUs']);
            session()->setFlashdata('resultFooterAboutUs', lang('settings_footer_about_us_success'));
            $this->saveHistory('Change footer about us info');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('contactsEmailTo') != null) {
            $this->homeAdminModel->setValueStore('contactsEmailTo', $_POST['contactsEmailTo']);
            session()->setFlashdata('resultEmailTo', lang('settings_email_success'));
            $this->saveHistory('Change where going emails from contact form');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('shippingOrder') != null) {
            $this->homeAdminModel->setValueStore('shippingOrder', $_POST['shippingOrder']);
            session()->setFlashdata('shippingOrder', lang('settings_shipping_order_success'));
            $this->saveHistory('Change Shipping free for order more than ' . $_POST['shippingOrder']);
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('shippingAmount') != null) {
            $this->homeAdminModel->setValueStore('shippingAmount', $_POST['shippingAmount']);
            session()->setFlashdata('shippingAmount', lang('settings_shipping_amount_success'));
            $this->saveHistory('Change Shipping amount for orders ' . $_POST['shippingAmount']);
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('addJs') != null) {
            $this->homeAdminModel->setValueStore('addJs', $_POST['addJs']);
            session()->setFlashdata('addJs', lang('settings_js_success'));
            $this->saveHistory('Add JS to website');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('publicQuantity') != null) {
            $this->homeAdminModel->setValueStore('publicQuantity', $_POST['publicQuantity']);
            session()->setFlashdata('publicQuantity', lang('settings_public_quantity_success'));
            $this->saveHistory('Change publicQuantity visibility');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('publicDateAdded') != null) {
            $this->homeAdminModel->setValueStore('publicDateAdded', $_POST['publicDateAdded']);
            session()->setFlashdata('publicDateAdded', lang('settings_public_date_added_success'));
            $this->saveHistory('Change public date added visibility');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('outOfStock') != null) {
            $this->homeAdminModel->setValueStore('outOfStock', $_POST['outOfStock']);
            session()->setFlashdata('outOfStock', lang('settings_out_of_stock_success'));
            $this->saveHistory('Change visibility of final checkout page');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('moreInfoBtn') != null) {
            $this->homeAdminModel->setValueStore('moreInfoBtn', $_POST['moreInfoBtn']);
            session()->setFlashdata('moreInfoBtn', lang('settings_more_info_btn_success'));
            $this->saveHistory('Change visibility of More Information button in products list');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('showBrands') != null) {
            $this->homeAdminModel->setValueStore('showBrands', $_POST['showBrands']);
            session()->setFlashdata('showBrands', lang('settings_brands_success'));
            $this->saveHistory('Brands visibility changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('showProductPrice') != null) {
            $this->homeAdminModel->setValueStore('showProductPrice', $_POST['showProductPrice']);
            session()->setFlashdata('showProductPrice', lang('settings_show_product_price_success'));
            $this->saveHistory('Show price on product card setting changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('virtualProducts') != null) {
            $this->homeAdminModel->setValueStore('virtualProducts', $_POST['virtualProducts']);
            session()->setFlashdata('virtualProducts', lang('settings_virtual_products_success'));
            $this->saveHistory('Virtual products visibility changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('showInSlider') != null) {
            $this->homeAdminModel->setValueStore('showInSlider', $_POST['showInSlider']);
            session()->setFlashdata('showInSlider', lang('settings_in_slider_success'));
            $this->saveHistory('In Slider products visibility changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('multiVendor') != null) {
            $this->homeAdminModel->setValueStore('multiVendor', $_POST['multiVendor']);
            session()->setFlashdata('multiVendor', lang('settings_multi_vendor_success'));
            $this->saveHistory('Multi Vendor Support changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('setCookieLaw') != null) {
            unset($_POST['setCookieLaw']);
            $this->setCookieLaw($_POST);
            $this->saveHistory('Cookie law information changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('hideBuyButtonsOfOutOfStock') != null) {
            $this->homeAdminModel->setValueStore('hideBuyButtonsOfOutOfStock', $_POST['hideBuyButtonsOfOutOfStock']);
            session()->setFlashdata('hideBuyButtonsOfOutOfStock', lang('settings_hide_buy_success'));
            $this->saveHistory('Buy buttons visibility changed for out of stock products');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('refreshAfterAddToCart') != null) {
            $this->homeAdminModel->setValueStore('refreshAfterAddToCart', $_POST['refreshAfterAddToCart']);
            session()->setFlashdata('refreshAfterAddToCart', lang('settings_saved'));
            $this->saveHistory('Option to open shopping cart after click add to cart button changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('newProductsLimit') != null) {
            $limit = (int) $this->request->getPost('newProductsLimit');
            if ($limit > 0) {
                $this->homeAdminModel->setValueStore('newProductsLimit', $limit);
                session()->setFlashdata('newProductsLimit', lang('settings_new_products_limit_success'));
                $this->saveHistory('Change new products limit to ' . $limit);
            }
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('lastBlogsLimit') != null) {
            $limit = (int) $this->request->getPost('lastBlogsLimit');
            if ($limit > 0) {
                $this->homeAdminModel->setValueStore('lastBlogsLimit', $limit);
                session()->setFlashdata('lastBlogsLimit', lang('settings_last_blogs_limit_success'));
                $this->saveHistory('Change last blogs limit to ' . $limit);
            }
            redirect()->to(base_url('admin/settings'));
        }
    }

    private function setCookieLaw(array $post)
    {
        $this->homeAdminModel->setCookieLaw($post);
    }

    private function getCookieLaw()
    {
        return $this->homeAdminModel->getCookieLaw();
    }
}
