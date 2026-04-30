<?php

namespace App\Controllers;

use App\Core\MyController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Product extends MyController
{
    protected $Public_model;
    protected $Home_admin_model;

    public function __construct()
    {
        parent::__construct();
        $this->Public_model = model(\App\Models\PublicModel::class);
        $this->Home_admin_model = model(\App\Modules\Admin\Models\HomeAdminModel::class);
    }

    public function viewProduct($id)
    {
        $data = [];
        $head = [];

        $data['product'] = $this->Public_model->getOneProduct($id);
        if ($data['product'] === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data['sameCagegoryProducts'] = $this->Public_model->sameCategoryProducts($data['product']['shop_categorie'], $id);
        $data['publicDateAdded'] = $this->Home_admin_model->getValueStore('publicDateAdded');
        $head['title'] = $data['product']['title'];

        $description = url_title(character_limiter(strip_tags($data['product']['description']), 130));
        $description = str_replace('-', ' ', $description) . '..';
        $head['description'] = $description;
        $head['keywords'] = str_replace(' ', ',', $data['product']['title']);

        $head['image'] = null;
        if (isset($data['product']['image'])) {
            $head['image'] = base_url('/attachments/shop_images/' . $data['product']['image']);
        }

        $this->render('view_product', $head, $data);
    }

    public function viewProductBySlug($slug)
    {
        if (empty($slug)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $productId = db_connect()->table('products')
            ->select('id')
            ->where('url', $slug)
            ->limit(1)
            ->get()
            ->getRow('id');

        if (empty($productId)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $this->viewProduct((int) $productId);
    }
}
