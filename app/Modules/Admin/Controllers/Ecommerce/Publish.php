<?php
namespace App\Modules\Admin\Controllers\Ecommerce;

use App\Core\AdminController;

class Publish extends AdminController
{
    protected $Products_model;
    protected $Languages_model;
    protected $Brands_model;
    protected $Categories_model;
    protected $session;

    public function __construct()
    {
        parent::__construct();
        $this->Products_model   = model(\App\Modules\Admin\Models\ProductsModel::class);
        $this->Languages_model  = model(\App\Modules\Admin\Models\LanguagesModel::class);
        $this->Brands_model     = model(\App\Modules\Admin\Models\BrandsModel::class);
        $this->Categories_model = model(\App\Modules\Admin\Models\CategoriesModel::class);
        $this->session          = session();
    }

    public function index($id = 0)
    {
        $this->login_check();
        $trans_load = null;

        // If editing and no POST, load existing product
        if ($id > 0 && empty($_POST)) {
            $_POST = (array) $this->Products_model->getOneProduct($id);
            $trans_load = $this->Products_model->getTranslations($id);
        }

        // Form submit
        if ($this->request->getPost('submit')) {
            $id = $this->request->getPost('item_id');
            if ($this->request->getGet('to_lang')) {
                $id = 0;
            }

            $_POST = $this->request->getPost();
            $_POST['image'] = $this->uploadImage();

            $this->Products_model->setProduct($_POST, $id);
            $this->session->setFlashdata('result_publish', 'Product is published!');

            $this->saveHistory($id == 0 ? 'Success published product' : 'Success updated product');

            // Preserve filters if updating
            if ($this->session->has('filter') && $id > 0) {
                $get = http_build_query($this->session->get('filter'));
                return redirect()->to(base_url('admin/products?' . $get));
            }

            return redirect()->to('admin/products');
        }

        // Prepare data
        $data = [
            'id'              => $id,
            'trans_load'      => $trans_load,
            'languages'       => $this->Languages_model->getLanguages(),
            'shop_categories' => $this->Categories_model->getShopCategories(),
            'brands'          => $this->Brands_model->getBrands(),
            'otherImgs'       => $this->loadOthersImages()
        ];

        $head = [
            'title'       => 'Administration - Publish Product',
            'description' => '!',
            'keywords'    => ''
        ];
        
        $validation = \Config\Services::validation();
        
        echo view('\App\Modules\Admin\Views\Ecommerce\publish', array_merge($head, $data, ['validation' => $validation]));

        $this->saveHistory('Go to publish product');
    }

    private function uploadImage()
    {
        $file = $this->request->getFile('userfile');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'attachments/shop_images', $newName);
            return $newName;
        }
        log_message('error', 'Image Upload Error: ' . ($file ? $file->getErrorString() : 'No file uploaded'));
        return null;
    }

    public function do_upload_others_images()
    {
        if ($this->request->isAJAX()) {
            $folder = $this->request->getPost('folder');
            $upath  = FCPATH . 'attachments/shop_images/' . $folder . '/';

            if (!is_dir($upath)) {
                mkdir($upath, 0777, true);
            }

            $files = $this->request->getFiles();
            if (isset($files['others'])) {
                foreach ($files['others'] as $file) {
                    if ($file->isValid()) {
                        $file->move($upath);
                    }
                }
            }
        }
    }

    public function loadOthersImages()
    {
        $output = '';
        $folder = $this->request->getPost('folder');

        if ($folder) {
            $dir = FCPATH . 'attachments/shop_images/' . $folder . '/';

            if (is_dir($dir) && ($dh = opendir($dir))) {
                $i = 0;
                while (($file = readdir($dh)) !== false) {
                    if (is_file($dir . $file)) {
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

    public function removeSecondaryImage()
    {
        if ($this->request->isAJAX()) {
            $basePath = realpath(FCPATH . 'attachments/shop_images');
            $folder   = realpath($basePath . DIRECTORY_SEPARATOR . $this->request->getPost('folder'));
            $image    = $this->request->getPost('image');

            if ($folder !== false && strpos($folder, $basePath) === 0 && is_file($folder . DIRECTORY_SEPARATOR . $image)) {
                unlink($folder . DIRECTORY_SEPARATOR . $image);
            }
        }
    }
}