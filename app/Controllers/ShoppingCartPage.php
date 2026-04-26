<?php




namespace App\Controllers;
use App\Core\MyController;

class ShoppingCartPage extends MyController
{
    protected $Public_model;

    public function __construct()
    {
        parent::__construct();
        $this->Public_model = model(\App\Models\PublicModel::class);
    }

    public function index()
    {
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('shoppingcart');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
        $this->render('shopping_cart', $head, $data);
    }

}
