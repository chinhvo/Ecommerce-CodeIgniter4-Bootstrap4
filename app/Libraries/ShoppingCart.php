<?php

namespace App\Libraries;
use Config\Services;

class ShoppingCart
{
    public $sumValues;
    private $cookieExpTime = 2678400; // 1 month

    protected $homeAdminModel;
    protected $publicModel;
    protected $session;
    protected $request;
    protected $response;

    public function __construct()
    {
        helper(['cookie']); // For set_cookie(), get_cookie(), delete_cookie()

        $this->homeAdminModel = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->publicModel    = model(\App\Models\PublicModel::class);
        $this->session        = Services::session();
        $this->request        = Services::request();
        $this->response       = Services::response();
    }

    public function manageShoppingCart()
    {
        $action    = $this->request->getPost('action');
        $articleId = (int) $this->request->getPost('article_id');

        if ($action === 'add') {
            $cart = $this->session->get('shopping_cart') ?? [];
            $cart[] = $articleId;
            $this->session->set('shopping_cart', $cart);
        }

        if ($action === 'remove') {
            $cart = $this->session->get('shopping_cart') ?? [];
            if (($key = array_search($articleId, $cart)) !== false) {
                unset($cart[$key]);
                $this->session->set('shopping_cart', $cart);
            }
        }

        set_cookie('shopping_cart', serialize($this->session->get('shopping_cart')), $this->cookieExpTime);

        $result = 0;
        if (!empty($this->session->get('shopping_cart'))) {
            $result = $this->getCartItems();
        }

        // Call your loop class method (update as needed for CI4)
        if (class_exists('App\Libraries\Loop')) {
            \App\Libraries\Loop::getCartItems($result);
        }
    }

    public function removeFromCart()
    {
        $deleteId = (int) $this->request->getGet('delete-product');
        $cart     = $this->session->get('shopping_cart') ?? [];

        $count = count(array_keys($cart, $deleteId));
        $i = 1;
        do {
            if (($key = array_search($deleteId, $cart)) !== false) {
                unset($cart[$key]);
            }
            $i++;
        } while ($i <= $count);

        $this->session->set('shopping_cart', $cart);
        set_cookie('shopping_cart', serialize($cart), $this->cookieExpTime);
    }

    public function getCartItems()
    {
        $cart = $this->session->get('shopping_cart');

        if ((empty($cart) || !is_array($cart)) && get_cookie('shopping_cart') !== null) {
            $cart = unserialize(get_cookie('shopping_cart'));
            $this->session->set('shopping_cart', $cart);
        } elseif (empty($cart) || !is_array($cart)) {
            return 0;
        }

        $result['array'] = $this->publicModel->getShopItems(array_unique($cart));

        if (empty($result['array'])) {
            $this->session->remove('shopping_cart');
            delete_cookie('shopping_cart');
            return 0;
        }

        $count_articles = array_count_values($cart);
        $this->sumValues = array_sum($count_articles);
        $finalSum = 0;

        foreach ($result['array'] as &$article) {
            $article['num_added']  = $count_articles[$article['id']];
            $article['price']      = $article['price'] === '' ? 0 : $article['price'];
            $article['sum_price']  = $article['price'] * $count_articles[$article['id']];
            $finalSum += $article['sum_price'];
            $article['sum_price']  = number_format($article['sum_price'], 2);
            $article['price']      = $article['price'] !== '' ? number_format($article['price'], 2) : 0;
        }

        $result['finalSum'] = number_format($finalSum, 2);
        return $result;
    }

    public function clearShoppingCart()
    {
        $this->session->remove('shopping_cart');
        delete_cookie('shopping_cart');

        if ($this->request->isAJAX()) {
            echo 1;
        }
    }
}