<?php
namespace App\Controllers;
use App\Core\MyController;

class Home extends MyController
{
    protected $Public_model;
    protected $Home_admin_model;
    protected $Brands_model;

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->Public_model = model(\App\Models\PublicModel::class);
        $this->Home_admin_model = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->Brands_model = model(\App\Modules\Admin\Models\BrandsModel::class);
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('home');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
        $data['countQuantities'] = $this->Public_model->getCountQuantities();
        $data['bestSellers'] = $this->Public_model->getbestSellers();
        $data['newProducts'] = $this->Public_model->getNewProducts();
        $data['sliderProducts'] = $this->Public_model->getSliderProducts();
        $data['highlightedProducts'] = $this->Public_model->getHighlightedProducts();
        $data['lastBlogs'] = $this->Public_model->getLastBlogs();
        $data['products'] = $this->Public_model->getProducts($this->num_rows, $page, $_GET);
        $rowscount = $this->Public_model->productsCount($_GET);
        $data['shippingOrder'] = $this->Home_admin_model->getValueStore('shippingOrder');
        $data['showOutOfStock'] = $this->Home_admin_model->getValueStore('outOfStock');
        $data['showBrands'] = $this->Home_admin_model->getValueStore('showBrands');
        $data['brands'] = $this->Brands_model->getBrands();
        $data['links_pagination'] = pagination('home', $rowscount, $this->num_rows, $page);
        $this->render('home', $head, $data);
    }

    /*
     * Used from greenlabel template
     * shop page
     */

    public function shop($page = 0)
    {
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('shop');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
        $data['countQuantities'] = $this->Public_model->getCountQuantities();
        $data['showBrands'] = $this->Home_admin_model->getValueStore('showBrands');
        $data['brands'] = $this->Brands_model->getBrands();
        $data['showOutOfStock'] = $this->Home_admin_model->getValueStore('outOfStock');
        $data['shippingOrder'] = $this->Home_admin_model->getValueStore('shippingOrder');
        $data['products'] = $this->Public_model->getProducts($this->num_rows, $page, $_GET);
        $rowscount = $this->Public_model->productsCount($_GET);
        $data['links_pagination'] = pagination('home', $rowscount, $this->num_rows, $page);
        $this->render('shop', $head, $data);
    }

    /*
     * Called to add/remove quantity from cart
     * If is ajax request send POST'S to class ShoppingCart
     */

    public function manageShoppingCart()
    {
        if (!$this->request->isAJAX()) {
            exit('No direct script access allowed');
        }
        $this->shoppingcart->manageShoppingCart();
    }

    /*
     * Called to remove product from cart
     * If is ajax request and send $_GET variable to the class
     */

    public function removeFromCart()
    {
        $backTo = (string) ($this->request->getGet('back-to') ?? 'shopping-cart');
        if ($backTo !== 'checkout' && $backTo !== 'shopping-cart') {
            $backTo = 'shopping-cart';
        }

        $this->shoppingcart->removeFromCart();
        $this->session->setFlashdata('deleted', lang('deleted_product_from_cart'));

        return redirect()->to(base_url($backTo));
    }

    public function clearShoppingCart()
    {
        $this->shoppingcart->clearShoppingCart();
    }

    public function confirmLink($md5)
    {
        if (preg_match('/^[a-f0-9]{32}$/', $md5)) {
            $result = $this->Public_model->confirmOrder($md5);
            if ($result === true) {
                $data = array();
                $head = array();
                $head['title'] = '';
                $head['description'] = '';
                $head['keywords'] = '';
                $this->render('confirmed', $head, $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function discountCodeChecker()
    {
        if (!$this->request->isAJAX()) {
            exit('No direct script access allowed');
        }
        $result = $this->Public_model->getValidDiscountCode($_POST['enteredCode']);
        if ($result == null) {
            echo 0;
        } else {
            echo json_encode($result);
        }
    }

    public function sitemap()
    {
        header("Content-Type:text/xml");
        echo '<?xml version="1.0" encoding="UTF-8"?>
                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $products = $this->Public_model->sitemap();
        $blogPosts = $this->Public_model->sitemapBlog();

        foreach ($blogPosts->getResult() as $row1) {
            echo '<url>

      <loc>' . base_url('blog/' . $row1->url) . '</loc>

      <changefreq>monthly</changefreq>

      <priority>0.1</priority>

   </url>';
        }

        echo '<url>

        <loc>' . base_url('/kirilkirkov-ecommerce-ci-b3-hcheck') . '</loc>

        <changefreq>monthly</changefreq>

        <priority>0.1</priority>

        </url>';

        foreach ($products->getResult() as $row) {
            echo '<url>

      <loc>' . base_url($row->url) . '</loc>

      <changefreq>monthly</changefreq>

      <priority>0.1</priority>

   </url>';
        }

        echo '</urlset>';
    }

    public function platform()
    {
        echo view('main/platform/index');
    }
}
