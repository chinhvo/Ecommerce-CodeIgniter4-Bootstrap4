<?php
namespace App\Modules\Admin\Controllers\Ecommerce;

use App\Core\AdminController;

class Products extends AdminController
{
    private $num_rows = 10;
    private $segment = 3;
    protected $Products_model;
    protected $Languages_model;
    protected $Categories_model;
    protected $session;
    
    public function __construct()
    {
        parent::__construct();
        $this->Products_model   = model(\App\Modules\Admin\Models\ProductsModel::class);
        $this->Languages_model  = model(\App\Modules\Admin\Models\LanguagesModel::class);
        $this->Categories_model = model(\App\Modules\Admin\Models\CategoriesModel::class);
        $this->session          = session();
    }

    public function index($page = 0)
    {
        $this->login_check();

        $head = [
            'title'       => 'Administration - View products',
            'description' => '!',
            'keywords'    => ''
        ];

        // Delete product
        if ($this->request->getGet('delete')) {
            $id = $this->request->getGet('delete');
            $this->Products_model->deleteProduct($id);
            $this->session->setFlashdata('result_delete', 'Product is deleted!');
            $this->saveHistory('Delete product id - ' . $id);
            return redirect()->to('admin/products');
        }

        // Reset filters
        $this->session->remove('filter');
        $filters = [];

        // Search by title
        $search_title = $this->request->getGet('search_title');
        if ($search_title !== null) {
            $filters['search_title'] = $search_title;
            $this->session->set('filter.search_title', $search_title);
            $this->saveHistory('Search for product title - ' . $search_title);
        }

        // Order by
        $orderby = $this->request->getGet('order_by');
        if ($orderby !== null) {
            $filters['order_by'] = $orderby;
            $this->session->set('filter.order_by', $orderby);
        }

        // Filter by category
        $category = $this->request->getGet('category')?: null;
        if ($category !== null) {
            $filters['category'] = $category;
            $this->session->set('filter.category', $category);
            $this->saveHistory('Search for product category - ' . $category);
        }

        // Filter by vendor
        $vendor = $this->request->getGet('show_vendor');
        if ($vendor !== null) {
            $filters['vendor'] = $vendor;
        }

        $data = [];
        $data['products_lang'] = $this->session->get('admin_lang_products');
        $rowscount = $this->Products_model->productsCount($search_title, $category);
        $data['products'] = $this->Products_model->getProducts($this->num_rows, $page, $search_title, $orderby, $category, $vendor);
        $data['links_pagination'] = pagination('admin/products', $rowscount, $this->num_rows, $page, $this->segment);
        $data['num_shop_art'] = $this->Products_model->numShopProducts();
        $data['languages'] = $this->Languages_model->getLanguages();
        $data['shop_categories'] = $this->Categories_model->getShopCategories(null, null, 2);


        echo view('\App\Modules\Admin\Views\Ecommerce\products', array_merge($data, $head));
        $this->saveHistory('Go to products');
    }

    public function getProductInfo($id, $noLoginCheck = false)
    {
        // If method is called from admin side, check login
        if (!$noLoginCheck) {
            $this->login_check();
        }
        return $this->Products_model->getOneProduct($id);
    }

    public function productStatusChange()
    {
        $this->login_check();

        $id = $this->request->getPost('id');
        $to_status = $this->request->getPost('to_status');

        $result = $this->Products_model->productStatusChange($id, $to_status);
        echo $result ? 1 : 0;

        $this->saveHistory("Change product id {$id} to status {$to_status}");
    }
}