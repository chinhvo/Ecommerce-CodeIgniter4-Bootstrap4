<?php


namespace App\Controllers;
/*
 * Only vendors class
 */


use App\Core\MyController;

class Vendor extends MyController
{
    protected $Public_model;
    protected $Home_admin_model;
    protected $Vendorprofile_model;

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->Public_model = model(\App\Models\PublicModel::class);
        $this->Home_admin_model = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->Vendorprofile_model = model(\App\Modules\Admin\Models\VendorsModel::class);
    }

    private function getVendorByUrlAddress($vendor)
    {
        return $this->Vendorprofile_model
            ->where('url', $vendor)
            ->first();
    }

    public function index($page = 0, $vendor)
    {
        $vendorInfo = $this->getVendorByUrlAddress($vendor);
        if ($vendorInfo == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = array();
        $head = array();
        $head['title'] = $vendorInfo['name'];
        $head['description'] = lang('vendor_view') . $vendorInfo['name'];
        $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
        $head['vendor_url'] = LANG_URL . '/vendor/view/' . $vendor;
        $all_categories = $this->Public_model->getShopCategories();

        /*
         * Tree Builder for categories menu
         */

        function buildTree(array $elements, $parentId = 0)
        {
            $branch = array();
            foreach ($elements as $element) {
                if ($element['sub_for'] == $parentId) {
                    $children = buildTree($elements, $element['id']);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
            return $branch;
        }

        $data['home_categories'] = $tree = buildTree($all_categories);
        $data['all_categories'] = $all_categories;
        $data['vendorInfo'] = $vendorInfo;
        $data['products'] = $this->Public_model->getProducts($this->num_rows, $page, $_GET, $vendorInfo['id']);
        $rowscount = $this->Public_model->productsCount($_GET);
        $data['links_pagination'] = pagination('vendor/view/' . $vendor, $rowscount, $this->num_rows, $page, 4);
        $this->render('vendor', $head, $data);
    }

    public function viewProduct($vendor, $id)
    {
        $vendorInfo = $this->getVendorByUrlAddress($vendor);
        if ($vendorInfo == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = array();
        $head = array();
        $data['product'] = $this->Public_model->getOneProduct($id);
        $data['sameCagegoryProducts'] = $this->Public_model->sameCagegoryProducts($data['product']['shop_categorie'], $id, $vendorInfo['id']);
        if ($data['product'] === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['publicDateAdded'] = $this->Home_admin_model->getValueStore('publicDateAdded');
        $head['title'] = $vendorInfo['name'] . ' - ' . $data['product']['title'];
        $description = url_title(character_limiter(strip_tags($data['product']['description']), 130));
        $description = str_replace("-", " ", $description) . '..';
        $head['description'] = $description;
        $head['keywords'] = str_replace(" ", ",", $data['product']['title']);
        $data['vendorInfo'] = $vendorInfo;
        $this->render('view_product_vendor', $head, $data);
    }

}
