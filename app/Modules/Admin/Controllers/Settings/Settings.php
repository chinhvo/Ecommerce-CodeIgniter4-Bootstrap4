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
        echo view('\App\Modules\Admin\Views\settings\settings', array_merge($data, $head));

        $this->saveHistory('Go to Settings Page');
    }

    private function getValueStores()
    {
        $values = $this->settingsModel->getValueStores();

        return (!empty($values) && is_array($values)) ? $values : null;
    }

    private function postChecker()
    {
        if ($this->request->getPost('uploadimage')) {
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
                    session()->setFlashdata('resultSiteLogoPublish', 'Only gif, jpg, jpeg, and png files are allowed.');
                } elseif ($logoFile->getSize() > $maxSizeInBytes) {
                    session()->setFlashdata('resultSiteLogoPublish', 'The site logo must not exceed 1500 KB.');
                } elseif ($imageInfo === false) {
                    session()->setFlashdata('resultSiteLogoPublish', 'The uploaded file is not a valid image.');
                } elseif ($imageInfo[0] > $maxWidth || $imageInfo[1] > $maxHeight) {
                    session()->setFlashdata('resultSiteLogoPublish', 'The site logo exceeds the maximum dimensions of 1024x768 pixels.');
                } else {
                    $newImage = $logoFile->getRandomName();
                    $logoFile->move($uploadPath, $newImage, true);

                    if (!$logoFile->hasMoved()) {
                        session()->setFlashdata('resultSiteLogoPublish', 'The site logo could not be saved.');
                        return redirect()->to(base_url('admin/settings'));
                    }

                    $this->homeAdminModel->setValueStore('sitelogo', $newImage);
                    $this->saveHistory('Change site logo');
                    session()->setFlashdata('resultSiteLogoPublish', 'New logo is set!');
                }
            }
            return redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('naviText')) {
            $this->homeAdminModel->setValueStore('navitext', $_POST['naviText']);
            session()->setFlashdata('resultNaviText', 'New navigation text is set!');
            $this->saveHistory('Change navigation text');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('footerCopyright')) {
            $this->homeAdminModel->setValueStore('footercopyright', $_POST['footerCopyright']);
            session()->setFlashdata('resultFooterCopyright', 'New navigation text is set!');
            $this->saveHistory('Change footer copyright');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('contactsPage')) {
            $this->homeAdminModel->setValueStore('contactspage', $_POST['contactsPage']);
            session()->setFlashdata('resultContactspage', 'Contacts page is updated!');
            $this->saveHistory('Change contacts page');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('footerContacts')) {
            $this->homeAdminModel->setValueStore('footerContactAddr', $_POST['footerContactAddr']);
            $this->homeAdminModel->setValueStore('footerContactPhone', $_POST['footerContactPhone']);
            $this->homeAdminModel->setValueStore('footerContactEmail', $_POST['footerContactEmail']);
            session()->setFlashdata('resultfooterContacts', 'Contacts on footer are updated!');
            $this->saveHistory('Change footer contacts');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('footerSocial')) {
            $this->homeAdminModel->setValueStore('footerSocialFacebook', $_POST['footerSocialFacebook']);
            $this->homeAdminModel->setValueStore('footerSocialTwitter', $_POST['footerSocialTwitter']);
            $this->homeAdminModel->setValueStore('footerSocialGooglePlus', $_POST['footerSocialGooglePlus']);
            $this->homeAdminModel->setValueStore('footerSocialPinterest', $_POST['footerSocialPinterest']);
            $this->homeAdminModel->setValueStore('footerSocialYoutube', $_POST['footerSocialYoutube']);
            $this->homeAdminModel->setValueStore('footerSocialZalo', $_POST['footerSocialZalo']);
            session()->setFlashdata('resultfooterSocial', 'Social on footer are updated!');
            $this->saveHistory('Change footer contacts');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('googleMaps')) {
            $this->homeAdminModel->setValueStore('googleMaps', $_POST['googleMaps']);
            $this->homeAdminModel->setValueStore('googleApi', $_POST['googleApi']);
            session()->setFlashdata('resultGoogleMaps', 'Google maps coordinates and api key are updated!');
            $this->saveHistory('Update Google Maps Coordinates and Api Key');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('footerAboutUs')) {
            $this->homeAdminModel->setValueStore('footerAboutUs', $_POST['footerAboutUs']);
            session()->setFlashdata('resultFooterAboutUs', 'Footer about us text changed!');
            $this->saveHistory('Change footer about us info');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('contactsEmailTo')) {
            $this->homeAdminModel->setValueStore('contactsEmailTo', $_POST['contactsEmailTo']);
            session()->setFlashdata('resultEmailTo', 'Email changed!');
            $this->saveHistory('Change where going emails from contact form');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('shippingOrder')) {
            $this->homeAdminModel->setValueStore('shippingOrder', $_POST['shippingOrder']);
            session()->setFlashdata('shippingOrder', 'Shipping Order price chagned!');
            $this->saveHistory('Change Shipping free for order more than ' . $_POST['shippingOrder']);
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('shippingAmount')) {
            $this->homeAdminModel->setValueStore('shippingAmount', $_POST['shippingAmount']);
            session()->setFlashdata('shippingAmount', 'Shipping amount price chagned!');
            $this->saveHistory('Change Shipping amount for orders ' . $_POST['shippingAmount']);
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('addJs')) {
            $this->homeAdminModel->setValueStore('addJs', $_POST['addJs']);
            session()->setFlashdata('addJs', 'JavaScript code is added');
            $this->saveHistory('Add JS to website');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('publicQuantity')) {
            $this->homeAdminModel->setValueStore('publicQuantity', $_POST['publicQuantity']);
            session()->setFlashdata('publicQuantity', 'Public quantity visibility changed');
            $this->saveHistory('Change publicQuantity visibility');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('publicDateAdded')) {
            $this->homeAdminModel->setValueStore('publicDateAdded', $_POST['publicDateAdded']);
            session()->setFlashdata('publicDateAdded', 'Public date added visibility changed');
            $this->saveHistory('Change public date added visibility');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('outOfStock')) {
            $this->homeAdminModel->setValueStore('outOfStock', $_POST['outOfStock']);
            session()->setFlashdata('outOfStock', 'Out of stock settings visibility change');
            $this->saveHistory('Change visibility of final checkout page');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('moreInfoBtn')) {
            $this->homeAdminModel->setValueStore('moreInfoBtn', $_POST['moreInfoBtn']);
            session()->setFlashdata('moreInfoBtn', 'Button More Information visibility is changed');
            $this->saveHistory('Change visibility of More Information button in products list');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('showBrands')) {
            $this->homeAdminModel->setValueStore('showBrands', $_POST['showBrands']);
            session()->setFlashdata('showBrands', 'Brands visibility changed');
            $this->saveHistory('Brands visibility changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('virtualProducts')) {
            $this->homeAdminModel->setValueStore('virtualProducts', $_POST['virtualProducts']);
            session()->setFlashdata('virtualProducts', 'Virtual products visibility changed');
            $this->saveHistory('Virtual products visibility changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('showInSlider')) {
            $this->homeAdminModel->setValueStore('showInSlider', $_POST['showInSlider']);
            session()->setFlashdata('showInSlider', 'In Slider products visibility changed');
            $this->saveHistory('In Slider products visibility changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('multiVendor')) {
            $this->homeAdminModel->setValueStore('multiVendor', $_POST['multiVendor']);
            session()->setFlashdata('multiVendor', 'Multi Vendor Support changed');
            $this->saveHistory('Multi Vendor Support changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('setCookieLaw')) {
            unset($_POST['setCookieLaw']);
            $this->setCookieLaw($_POST);
            $this->saveHistory('Cookie law information changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('hideBuyButtonsOfOutOfStock')) {
            $this->homeAdminModel->setValueStore('hideBuyButtonsOfOutOfStock', $_POST['hideBuyButtonsOfOutOfStock']);
            session()->setFlashdata('hideBuyButtonsOfOutOfStock', 'Buy buttons of Out of stock products visibility changed');
            $this->saveHistory('Buy buttons visibility changed for out of stock products');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('refreshAfterAddToCart')) {
            $this->homeAdminModel->setValueStore('refreshAfterAddToCart', $_POST['refreshAfterAddToCart']);
            session()->setFlashdata('refreshAfterAddToCart', 'Saved');
            $this->saveHistory('Option to open shopping cart after click add to cart button changed');
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('newProductsLimit')) {
            $limit = (int) $this->request->getPost('newProductsLimit');
            if ($limit > 0) {
                $this->homeAdminModel->setValueStore('newProductsLimit', $limit);
                session()->setFlashdata('newProductsLimit', 'New products limit updated!');
                $this->saveHistory('Change new products limit to ' . $limit);
            }
            redirect()->to(base_url('admin/settings'));
        }
        if ($this->request->getPost('lastBlogsLimit')) {
            $limit = (int) $this->request->getPost('lastBlogsLimit');
            if ($limit > 0) {
                $this->homeAdminModel->setValueStore('lastBlogsLimit', $limit);
                session()->setFlashdata('lastBlogsLimit', 'Last blogs limit updated!');
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
