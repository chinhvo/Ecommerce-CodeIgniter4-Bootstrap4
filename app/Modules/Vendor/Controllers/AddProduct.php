<?php

namespace App\Modules\Vendor\Controllers;

use App\Core\VendorController;
use App\Modules\Admin\Models\LanguagesModel;
use App\Modules\Admin\Models\CategoriesModel;
use App\Modules\Admin\Models\HomeAdminModel;
use App\Modules\Admin\Models\BrandsModel;
use App\Modules\Vendor\Models\ProductsModel;
use CodeIgniter\HTTP\ResponseInterface;

class AddProduct extends VendorController
{
    protected $productsModel;
    protected $languagesModel;
    protected $categoriesModel;
    protected $homeAdminModel;
    protected $brandsModel;

    protected $allowedImgTypes = 'jpg|jpeg|png|gif';

    public function __construct()
    {
        parent::__construct();

        $this->productsModel   = new ProductsModel();
        $this->languagesModel  = new LanguagesModel();
        $this->categoriesModel = new CategoriesModel();
        $this->homeAdminModel  = new HomeAdminModel();
        $this->brandsModel     = new BrandsModel();
    }

    public function index(int $id = 0)
    {
        $transLoad = null;

        if ($id > 0 && $this->request->getPost() === null) {
            $_POST     = $this->productsModel->getOneProduct($id, $this->vendor_id);
            $transLoad = $this->productsModel->getTranslations($id);
        }

        if ($this->request->getPost('setProduct')) {
            $image = $this->uploadImage();
            $post  = $this->request->getPost();
            $post['image']     = $image;
            $post['vendor_id'] = $this->vendor_id;

            $result = $this->productsModel->setProduct($post, $id);

            $resultMsg = $result === true
                ? lang('vendor_product_published')
                : lang('vendor_product_publish_err');

            session()->setFlashdata('result_publish', $resultMsg);
            return redirect()->to(lang('Lang.url') . '/vendor/products');
        }

        $data = [
            'languages'       => $this->languagesModel->getLanguages(),
            'shop_categories' => $this->categoriesModel->getShopCategories(),
            'otherImgs'       => $this->loadOthersImages(),
            'showBrands'      => $this->homeAdminModel->getValueStore('showBrands'),
            'trans_load'      => $transLoad,
        ];

        if ($data['showBrands'] == 1) {
            $data['brands'] = $this->brandsModel->getBrands();
        }

        $head = [
            'title'       => lang('vendor_add_product'),
            'description' => lang('vendor_add_product'),
            'keywords'    => '',
        ];

        echo view('_parts/header', $head);
        echo view('add_product', $data);
        echo view('_parts/footer');
    }

    private function uploadImage(): ?string
    {
        $file = $this->request->getFile('userfile');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'attachments/shop_images', $newName);
            return $newName;
        }
        log_message('error', 'Image Upload Error: ' . $file->getErrorString());
        return null;
    }

    public function doUploadOthersImages(): ResponseInterface
    {
        if ($this->request->isAJAX()) {
            $folder = $this->request->getPost('folder');
            $upath  = FCPATH . 'attachments/shop_images/' . $folder;

            if (!is_dir($upath)) {
                mkdir($upath, 0777, true);
            }

            $files = $this->request->getFiles();
            if (isset($files['others'])) {
                foreach ($files['others'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $file->move($upath);
                    }
                }
            }
        }
        return $this->response->setStatusCode(200);
    }

    public function loadOthersImages()
    {
        $output = '';
        $folder = $this->request->getPost('folder');

        if (!empty($folder)) {
            $dir = FCPATH . 'attachments/shop_images/' . $folder;
            if (is_dir($dir) && ($dh = opendir($dir))) {
                $i = 0;
                while (($file = readdir($dh)) !== false) {
                    if (is_file($dir . '/' . $file)) {
                        $output .= '
                            <div class="other-img" id="image-container-' . $i . '">
                                <img src="' . base_url('attachments/shop_images/' . esc($folder) . '/' . $file) . '" style="width:100px; height: 100px;">
                                <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . esc($folder) . '\', ' . $i . ')">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </div>
                        ';
                    }
                    $i++;
                }
                closedir($dh);
            }
        }

        if ($this->request->isAJAX()) {
            return $this->response->setBody($output);
        }
        return $output;
    }

    public function removeSecondaryImage(): ResponseInterface
    {
        if ($this->request->isAJAX()) {
            $folder = $this->request->getPost('folder');
            $image  = $this->request->getPost('image');
            $path   = FCPATH . 'attachments/shop_images/' . $folder . '/' . $image;

            if (is_file($path)) {
                unlink($path);
            }
        }
        return $this->response->setStatusCode(200);
    }
}