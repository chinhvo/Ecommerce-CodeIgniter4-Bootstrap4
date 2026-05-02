<?php
namespace App\Modules\Vendor\Controllers;

use App\Core\VendorController;
use App\Modules\Vendor\Models\ProductsModel;

class Products extends VendorController
{
    private int $num_rows = 20;
    protected ProductsModel $productsModel;

    public function __construct()
    {
        parent::__construct();

        $this->productsModel = new ProductsModel();

        helper(['url', 'form', 'cookie', 'pagination']);
        session();
    }

    public function index(int $page = 0)
    {
        $deleteId = $this->request->getGet('delete');
        if ($deleteId) {
            $this->productsModel->deleteProduct($deleteId);
            session()->setFlashdata('result_delete', 'Product is deleted!');
            $this->saveHistory('Delete product id - ' . $deleteId);
            return redirect()->to('admin/products');
        }

        $rowscount = $this->productsModel->productsCount($this->vendor_id);

        $data = [
            'products'          => $this->productsModel->getProducts($this->num_rows, $page, $this->vendor_id),
            'links_pagination'  => pagination(
                'vendor/products',
                $rowscount,
                $this->num_rows,
                (defined('MY_LANGUAGE_ABBR') && defined('MY_DEFAULT_LANGUAGE_ABBR') && MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR) ? 3 : 4
            ),
        ];

        $head = [
            'title'       => lang('vendor_products'),
            'description' => lang('vendor_products'),
            'keywords'    => '',
        ];

        echo view('_parts/header', $head)
            . view('products', $data)
            . view('_parts/footer');
    }

    public function deleteProduct(int $id)
    {
        $this->productsModel->deleteProduct($id, $this->vendor_id);
        session()->setFlashdata('result_delete', lang('vendor_product_deleted'));
        return redirect()->to(LANG_URL . '/vendor/products');
    }

    public function logout()
    {
        session()->remove('logged_vendor');
        delete_cookie('logged_vendor');
        return redirect()->to(LANG_URL . '/vendor/login');
    }
}