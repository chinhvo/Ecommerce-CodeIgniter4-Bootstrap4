<?php
namespace App\Models;
use CodeIgniter\Model;

class PublicModel extends Model
{
    protected $HomeAdminModel;
    protected $encrypter;

    private $showOutOfStock;
    private $showInSliderProducts;
    private $multiVendor;
  
    public function __construct()
    {
        parent::__construct();
        
        // Load another model
        $this->HomeAdminModel = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        
        // Get values from that model
        $this->showOutOfStock      = $this->HomeAdminModel->getValueStore('outOfStock');
        $this->showInSliderProducts = $this->HomeAdminModel->getValueStore('showInSlider');
        $this->multiVendor         = $this->HomeAdminModel->getValueStore('multiVendor');
        
        // Load encryption service
        $this->encrypter = \Config\Services::encrypter();
    }

    public function productsCount(array $big_get = [])
    {
        $builder = $this->db->table('products');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $builder->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        
        if (!empty($big_get) && isset($big_get['category'])) {
            $this->getFilter($big_get, $builder); // pass builder to avoid mixing
        }
        
        $builder->where('visibility', 1);
        
        if ($this->showOutOfStock == 0) {
            $builder->where('quantity >', 0);
        }
        if ($this->showInSliderProducts == 0) {
            $builder->where('in_slider', 0);
        }
        if ($this->multiVendor == 0) {
            $builder->where('vendor_id', 0);
        }
        
        return $builder->countAllResults();
    }

    public function getNewProducts()
    {
        $builder = $this->db->table('products');
        $builder->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $builder->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $builder->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $builder->where('products.in_slider', 0);
        $builder->where('visibility', 1);
        
        if ($this->showOutOfStock == 0) {
            $builder->where('quantity >', 0);
        }
        
        $builder->orderBy('products.id', 'DESC');
        $builder->limit(5);
        
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getLastBlogs()
    {
        $builder = $this->db->table('blog_posts');
        $builder->limit(5);
        $builder->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $builder->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
        $builder->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image');
        
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPosts(int $limit, int $page, string $search = null, array $month = null)
    {
        $builder = $this->db->table('blog_posts');
        
        if ($search !== null) {
            // Use CI4's like/escape to prevent SQL injection
            $builder->groupStart()
            ->like('blog_translations.title', $search)
            ->orLike('blog_translations.description', $search)
            ->groupEnd();
        }
        
        if ($month !== null) {
            $from = intval($month['from']);
            $to   = intval($month['to']);
            $builder->where("time BETWEEN {$from} AND {$to}");
        }
        
        $builder->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $builder->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
        $builder->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image');
        
        $query = $builder->get($limit, $page);
        return $query->getResultArray();
    }
    

    public function getProducts(int $limit = null, int $start = null, array $big_get = [], $vendor_id = false)
    {
        $builder = $this->db->table('products');
        
        if ($limit !== null && $start !== null) {
            $builder->limit($limit, $start);
        }
        
        if (!empty($big_get) && isset($big_get['category'])) {
            $this->getFilter($big_get, $builder); // Pass builder to apply filters in CI4
        }
        
        $builder->select('vendors.url as vendor_url, products.id, products.image, products.quantity, products_translations.title, products_translations.price, products_translations.old_price, products.url');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $builder->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $builder->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $builder->where('visibility', 1);
        
        if ($vendor_id !== false) {
            $builder->where('vendor_id', $vendor_id);
        }
        if ($this->showOutOfStock == 0) {
            $builder->where('quantity >', 0);
        }
        if ($this->showInSliderProducts == 0) {
            $builder->where('in_slider', 0);
        }
        if ($this->multiVendor == 0) {
            $builder->where('vendor_id', 0);
        }
        
        $builder->orderBy('position', 'ASC');
        
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getOneLanguage(string $myLang)
    {
        $builder = $this->db->table('languages');
        $builder->select('*');
        $builder->where('abbr', $myLang);
        
        $result = $builder->get();
        return $result->getRowArray();
    }

    private function getFilter(array $big_get)
    {
        $builder = $this->db->table('products');
        
        if (!empty($big_get['category'])) {
            $findInIds = [$big_get['category']];
            
            // Get subcategories
            $query = $this->db->query(
                'SELECT id FROM shop_categories WHERE sub_for = ?',
                [$big_get['category']]
                );
            
            foreach ($query->getResult() as $row) {
                $findInIds[] = $row->id;
            }
            
            $builder->whereIn('products.shop_categorie', $findInIds);
        }
        
        if (isset($big_get['in_stock']) && $big_get['in_stock'] !== '') {
            $sign = ($big_get['in_stock'] == 1) ? '>' : '=';
            $builder->where("products.quantity {$sign}", 0);
        }
        
        if (!empty($big_get['search_in_title'])) {
            $builder->like('products_translations.title', $big_get['search_in_title']);
        }
        
        if (!empty($big_get['search_in_body'])) {
            $builder->like('products_translations.description', $big_get['search_in_body']);
        }
        
        if (!empty($big_get['order_price'])) {
            $builder->orderBy('products_translations.price', $big_get['order_price']);
        }
        
        if (!empty($big_get['order_procurement'])) {
            $builder->orderBy('products.procurement', $big_get['order_procurement']);
        }
        
        if (!empty($big_get['order_new'])) {
            $builder->orderBy('products.id', $big_get['order_new']);
        } else {
            $builder->orderBy('products.id', 'DESC');
        }
        
        if (!empty($big_get['quantity_more'])) {
            $builder->where('products.quantity >', $big_get['quantity_more']);
        }
        
        if (!empty($big_get['brand_id'])) {
            $builder->where('products.brand_id', $big_get['brand_id']);
        }
        
        if (!empty($big_get['added_after'])) {
            $added_after = \DateTime::createFromFormat('d/m/Y', $big_get['added_after']);
            if ($added_after) {
                $time = $added_after->getTimestamp();
                $builder->where('products.time >', $time);
            }
        }
        
        if (!empty($big_get['added_before'])) {
            $added_before = \DateTime::createFromFormat('d/m/Y', $big_get['added_before']);
            if ($added_before) {
                $time = $added_before->getTimestamp();
                $builder->where('products.time <', $time);
            }
        }
        
        if (!empty($big_get['price_from'])) {
            $builder->where('products_translations.price >=', $big_get['price_from']);
        }
        
        if (!empty($big_get['price_to'])) {
            $builder->where('products_translations.price <=', $big_get['price_to']);
        }
        
        return $builder;
    }

    public function getShopCategories()
    {
        $builder = $this->db->table('shop_categories_translations');
        $builder->select('shop_categories.sub_for, shop_categories.id, shop_categories_translations.name');
        $builder->where('abbr', MY_LANGUAGE_ABBR);
        $builder->orderBy('position', 'asc');
        $builder->join('shop_categories', 'shop_categories.id = shop_categories_translations.for_id', 'INNER');
        
        $query = $builder->get();
        $arr = [];
        
        if ($query->getNumRows() > 0) {
            foreach ($query->getResultArray() as $row) {
                $arr[] = $row;
            }
        }
        
        return $arr;
    }

    public function getSeo($page)
    {
        $builder = $this->db->table('seo_pages_translations');
        $builder->where('page_type', $page);
        $builder->where('abbr', MY_LANGUAGE_ABBR);
        
        $query = $builder->get();
        $arr = [];
        
        if ($query->getNumRows() > 0) {
            foreach ($query->getResultArray() as $row) {
                $arr['title'] = $row['title'];
                $arr['description'] = $row['description'];
            }
        }
        
        return $arr;
    }

    public function getOneProduct($id)
    {
        $builder = $this->db->table('products');
        $builder->select('
        vendors.url as vendor_url,
        products.*,
        products_translations.title,
        products_translations.description,
        products_translations.price,
        products_translations.old_price,
        products.url,
        shop_categories_translations.name as categorie_name
    ');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $builder->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        
        $builder->join('shop_categories_translations', 'shop_categories_translations.for_id = products.shop_categorie', 'inner');
        $builder->where('shop_categories_translations.abbr', MY_LANGUAGE_ABBR);
        
        $builder->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $builder->where('products.id', $id);
        $builder->where('visibility', 1);
        
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getCountQuantities()
    {
        $sql = 'SELECT
                SUM(IF(quantity <= 0, 1, 0)) AS out_of_stock,
                SUM(IF(quantity > 0, 1, 0)) AS in_stock
            FROM products
            WHERE visibility = 1';
        
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }

    public function getShopItems(array $array_items)
    {
        $builder = $this->db->table('products');
        
        $builder->select('
        products.id,
        products.image,
        products.url,
        products.quantity,
        products_translations.price,
        products_translations.title
    ');
        
        if (count($array_items) > 1) {
            $builder->whereIn('products.id', $array_items);
        } else {
            $builder->where('products.id', current($array_items));
        }
        
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'inner');
        $builder->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        
        $query = $builder->get();
        return $query->getResultArray();
    }

    /*
     * Users for notification by email
     */

    public function getNotifyUsers()
    {
        $builder = $this->db->table('users');
        $builder->select('email');
        $builder->where('notify', 1);
        
        $query = $builder->get();
        return array_column($query->getResultArray(), 'email');
    }

    public function setOrder(array $post)
    {
        // Get the last order_id
        $builder = $this->db->table('orders');
        $builder->selectMax('order_id');
        $query = $builder->get();
        $rr = $query->getRowArray();
        
        if (empty($rr['order_id']) || $rr['order_id'] == 0) {
            $rr['order_id'] = 1233;
        }
        $post['order_id'] = $rr['order_id'] + 1;
        
        // Prepare products array
        $post['products'] = [];
        foreach ($post['id'] as $i => $product) {
            $post['products'][$product] = $post['quantity'][$i];
        }
        unset($post['id'], $post['quantity']);
        $post['date'] = time();
        
        // Serialize product details
        $products_to_order = [];
        if (!empty($post['products'])) {
            foreach ($post['products'] as $pr_id => $pr_qua) {
                $products_to_order[] = [
                    'product_info'     => $this->getOneProductForSerialize($pr_id),
                    'product_quantity' => $pr_qua
                ];
            }
        }
        $post['products'] = serialize($products_to_order);
        
        // Begin transaction
        $this->db->transBegin();
        
        // Insert into orders table
        $orderData = [
            'order_id'       => $post['order_id'],
            'products'       => $post['products'],
            'date'           => $post['date'],
            'referrer'       => $post['referrer'] ?? null,
            'clean_referrer' => $post['clean_referrer'] ?? null,
            'payment_type'   => $post['payment_type'] ?? null,
            'paypal_status'  => $post['paypal_status'] ?? null,
            'discount_code'  => $post['discountCode'] ?? null,
            'user_id'        => $post['user_id'] ?? null
        ];
        $this->db->table('orders')->insert($orderData);
        
        $lastId = $this->db->insertID();
        
        // Insert into orders_clients table
        $clientData = [
            'for_id'     => $lastId,
            'first_name' => $this->encryption->encrypt($post['first_name']),
            'last_name'  => $this->encryption->encrypt($post['last_name']),
            'email'      => $this->encryption->encrypt($post['email']),
            'phone'      => $this->encryption->encrypt($post['phone']),
            'address'    => $this->encryption->encrypt($post['address']),
            'city'       => $this->encryption->encrypt($post['city']),
            'post_code'  => $this->encryption->encrypt($post['post_code']),
            'notes'      => $this->encryption->encrypt($post['notes'])
        ];
        $this->db->table('orders_clients')->insert($clientData);
        
        // Commit or rollback
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return $post['order_id'];
        }
    }
    
    private function getOneProductForSerialize($id)
    {
        $builder = $this->db->table('products');
        $builder->select('
        vendors.name AS vendor_name,
        vendors.id AS vendor_id,
        products.*,
        products_translations.price
    ');
        $builder->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'inner');
        $builder->where('products.id', $id);
        $builder->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        
        $query = $builder->get();
        
        return $query->getNumRows() > 0 ? $query->getRowArray() : false;
    }

    public function setVendorOrder($post)
    {
        $i = 0;
        $post['products'] = [];
        
        foreach ($post['id'] as $product) {
            $post['products'][$product] = $post['quantity'][$i];
            $i++;
        }
        
        // Loop products and check if its from vendor - save order for them
        foreach ($post['products'] as $product_id => $product_quantity) {
            $productInfo = $this->getOneProduct($product_id);
            
            if (!empty($productInfo['vendor_id']) && $productInfo['vendor_id'] > 0) {
                
                // Get the last vendor order ID
                $q = $this->db->query('SELECT MAX(order_id) as order_id FROM vendors_orders');
                $rr = $q->getRowArray();
                if (empty($rr['order_id'])) {
                    $rr['order_id'] = 1233;
                }
                $post['order_id'] = $rr['order_id'] + 1;
                
                // Prepare product data
                unset($post['id'], $post['quantity']);
                $post['date'] = time();
                $post['products'] = serialize([$product_id => $product_quantity]);
                
                // Start transaction
                $this->db->transBegin();
                
                // Insert into vendors_orders
                $insertOrder = [
                    'order_id'       => $post['order_id'],
                    'products'       => $post['products'],
                    'date'           => $post['date'],
                    'referrer'       => $post['referrer'],
                    'clean_referrer' => $post['clean_referrer'],
                    'payment_type'   => $post['payment_type'],
                    'paypal_status'  => $post['paypal_status'] ?? null,
                    'discount_code'  => $post['discountCode'] ?? null,
                    'vendor_id'      => $productInfo['vendor_id']
                ];
                
                if (! $this->db->table('vendors_orders')->insert($insertOrder)) {
                    log_message('error', print_r($this->db->error(), true));
                }
                
                $lastId = $this->db->insertID();
                
                // Insert into vendors_orders_clients
                $insertClient = [
                    'for_id'     => $lastId,
                    'first_name' => $this->encryption->encrypt($post['first_name']),
                    'last_name'  => $this->encryption->encrypt($post['last_name']),
                    'email'      => $this->encryption->encrypt($post['email']),
                    'phone'      => $this->encryption->encrypt($post['phone']),
                    'address'    => $this->encryption->encrypt($post['address']),
                    'city'       => $this->encryption->encrypt($post['city']),
                    'post_code'  => $this->encryption->encrypt($post['post_code']),
                    'notes'      => $this->encryption->encrypt($post['notes'])
                ];
                
                if (! $this->db->table('vendors_orders_clients')->insert($insertClient)) {
                    log_message('error', print_r($this->db->error(), true));
                }
                
                // Commit or rollback transaction
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                    return false;
                } else {
                    $this->db->transCommit();
                }
            }
        }
    }

    public function setActivationLink($link, $orderId)
    {
        return $this->db->table('confirm_links')->insert([
            'link'      => $link,
            'for_order' => $orderId
        ]);
    }
    
    public function getSliderProducts()
    {
        $builder = $this->db->table('products');
        $builder->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.basic_description, products_translations.old_price');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $builder->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $builder->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $builder->where('visibility', 1);
        $builder->where('in_slider', 1);
        
        if ($this->showOutOfStock == 0) {
            $builder->where('quantity >', 0);
        }
        
        return $builder->get()->getResultArray();
    }

    public function getBestSellers($categorie = 0, $noId = 0)
    {
        $builder = $this->db->table('products');
        $builder->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $builder->join('vendors', 'vendors.id = products.vendor_id', 'left');
        
        if ($noId > 0) {
            $builder->where('products.id !=', $noId);
        }
        
        $builder->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        
        if ($categorie != 0) {
            $builder->where('products.shop_categorie !=', $categorie);
        }
        
        $builder->where('visibility', 1);
        
        if ($this->showOutOfStock == 0) {
            $builder->where('quantity >', 0);
        }
        
        $builder->orderBy('products.procurement', 'DESC');
        $builder->limit(5);
        
        return $builder->get()->getResultArray();
    }
    
    public function sameCategoryProducts($categorie, $noId, $vendor_id = false)
    {
        $builder = $this->db->table('products');
        $builder->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $builder->join('vendors', 'vendors.id = products.vendor_id', 'left');
        
        $builder->where('products.id !=', $noId);
        
        if ($vendor_id !== false) {
            $builder->where('vendor_id', $vendor_id);
        }
        
        $builder->where('products.shop_categorie', $categorie);
        $builder->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $builder->where('visibility', 1);
        
        if ($this->showOutOfStock == 0) {
            $builder->where('quantity >', 0);
        }
        
        $builder->orderBy('products.id', 'DESC');
        $builder->limit(5);
        
        return $builder->get()->getResultArray();
    }

    public function getOnePost($id)
    {
        $builder = $this->db->table('blog_posts');
        $builder->select('blog_translations.title, blog_translations.description, blog_posts.image, blog_posts.time');
        $builder->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $builder->where('blog_posts.id', $id);
        $builder->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
        
        return $builder->get()->getRowArray();
    }

    public function getArchives()
    {
        $sql = "SELECT DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y') as month,
                   MAX(time) as maxtime,
                   MIN(time) as mintime
            FROM blog_posts
            GROUP BY DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y')";
        
        $result = $this->db->query($sql);
        
        if ($result->getNumRows() > 0) {
            return $result->getResultArray();
        }
        return false;
    }

    public function getFooterCategories()
    {
        $builder = $this->db->table('shop_categories_translations');
        $builder->select('shop_categories.id, shop_categories_translations.name');
        $builder->where('abbr', MY_LANGUAGE_ABBR);
        $builder->where('shop_categories.sub_for', 0);
        $builder->join('shop_categories', 'shop_categories.id = shop_categories_translations.for_id', 'inner');
        $builder->limit(10);
        
        $query = $builder->get();
        $arr = [];
        
        if ($query->getNumRows() > 0) {
            foreach ($query->getResultArray() as $row) {
                $arr[$row['id']] = $row['name'];
            }
        }
        
        return $arr;
    }

    public function setSubscribe($array)
    {
        $builder = $this->db->table('subscribed');
        $num = $builder->where('email', $array['email'])->countAllResults();
        
        if ($num == 0) {
            $builder->insert($array);
        }
    }
    
    public function getDynPagesLangs($dynPages)
    {
        if (!empty($dynPages)) {
            $builder = $this->db->table('active_pages');
            $builder->join('textual_pages_tanslations', 'textual_pages_tanslations.for_id = active_pages.id', 'left');
            $builder->whereIn('active_pages.name', $dynPages);
            $builder->where('textual_pages_tanslations.abbr', MY_LANGUAGE_ABBR);
            $builder->select('textual_pages_tanslations.name as lname, active_pages.name as pname');
            
            $result = $builder->get();
            
            $ar = [];
            foreach ($result->getResultArray() as $row) {
                $ar[] = [
                    'lname' => $row['lname'],
                    'pname' => $row['pname']
                ];
            }
            return $ar;
        }
        return $dynPages;
    }

    public function getOnePage($page)
    {
        $builder = $this->db->table('active_pages');
        $builder->join('textual_pages_tanslations', 'textual_pages_tanslations.for_id = active_pages.id', 'left');
        $builder->where('textual_pages_tanslations.abbr', MY_LANGUAGE_ABBR);
        $builder->where('active_pages.name', $page);
        $builder->select('textual_pages_tanslations.description as content, textual_pages_tanslations.name');
        
        $result = $builder->get();
        return $result->getRowArray();
    }

    public function changePaypalOrderStatus($order_id, $status)
    {
        $processed = 0;
        if ($status == 'canceled') {
            $processed = 2;
        }
        
        $builder = $this->db->table('orders');
        $builder->where('order_id', $order_id);
        
        if (!$builder->update([
            'paypal_status' => $status,
            'processed'     => $processed
        ])) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function getCookieLaw()
    {
        $builder = $this->db->table('cookie_law');
        $builder->join('cookie_law_translations', 'cookie_law_translations.for_id = cookie_law.id', 'inner');
        $builder->where('cookie_law_translations.abbr', MY_LANGUAGE_ABBR);
        $builder->where('cookie_law.visibility', '1');
        $builder->select('link, theme, message, button_text, learn_more');
        
        $query = $builder->get();
        
        if ($query->getNumRows() > 0) {
            return $query->getRowArray();
        } else {
            return false;
        }
    }

    public function confirmOrder($md5)
    {
        $builder = $this->db->table('confirm_links');
        $builder->where('link', $md5);
        $builder->limit(1);
        $query = $builder->get();
        $row = $query->getRowArray();
        
        if (!empty($row)) {
            $orderId = $row['for_order'];
            
            $updateBuilder = $this->db->table('orders');
            $updateBuilder->where('order_id', $orderId);
            $updateBuilder->limit(1);
            
            return $updateBuilder->update(['confirmed' => '1']);
        }
        
        return false;
    }

    public function getValidDiscountCode($code)
    {
        $time = time();
        
        $builder = $this->db->table('discount_codes');
        $builder->select('type, amount');
        $builder->where('code', $code);
        $builder->where("$time BETWEEN valid_from_date AND valid_to_date");
        
        $query = $builder->get();
        return $query->getRowArray();
    }
    
    public function countPublicUsersWithEmail($email, $id = 0)
    {
        $builder = $this->db->table('users_public');
        
        if ($id > 0) {
            $builder->where('id !=', $id);
        }
        
        $builder->where('email', $email);
        
        return $builder->countAllResults();
    }

    public function registerUser($post)
    {
        $this->db->table('users_public')->insert([
            'name'     => $post['name'],
            'phone'    => $post['phone'],
            'email'    => $post['email'],
            'password' => md5($post['pass'])
        ]);
        
        return $this->db->insertID();
    }

    public function updateProfile($post)
    {
        $data = [
            'name'  => $post['name'],
            'phone' => $post['phone'],
            'email' => $post['email']
        ];
        
        if (trim($post['pass']) !== '') {
            $data['password'] = md5($post['pass']); // Consider password_hash() for security
        }
        
        $this->db->table('users_public')
        ->where('id', $post['id'])
        ->update($data);
    }

    public function checkPublicUserIsValid($post)
    {
        $query = $this->db->table('users_public')
        ->where('email', $post['email'])
        ->where('password', md5($post['pass'])) // Consider using password_hash() & password_verify()
        ->get();
        
        $result = $query->getRowArray();
        
        if (empty($result)) {
            return false;
        }
        return $result['id'];
    }

    public function getUserProfileInfo($id)
    {
        return $this->db->table('users_public')
        ->where('id', $id)
        ->get()
        ->getRowArray();
    }

    public function sitemap()
    {
        return $this->db->table('products')
        ->select('url')
        ->get();
    }
    
    public function sitemapBlog()
    {
        return $this->db->table('blog_posts')
        ->select('url')
        ->get();
    }
    
    public function sitemapBlogAsArray()
    {
        return $this->db->table('blog_posts')
        ->select('url')
        ->get()
        ->getResultArray();
    }

    public function getUserOrdersHistoryCount($userId)
    {
        return $this->db->table('orders')
        ->where('user_id', $userId)
        ->countAllResults();
    }
    
    public function getUserOrdersHistory($userId, $limit, $page)
    {
        $builder = $this->db->table('orders');
        
        $builder->where('user_id', $userId)
        ->orderBy('id', 'DESC')
        ->select('orders.*, orders_clients.first_name,
                      orders_clients.last_name, orders_clients.email, orders_clients.phone,
                      orders_clients.address, orders_clients.city, orders_clients.post_code,
                      orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount')
                      ->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner')
                      ->join('discount_codes', 'discount_codes.code = orders.discount_code', 'left')
                      ->limit($limit, $page);
                      
                      $query  = $builder->get();
                      $result = $query->getResultArray();
                      
                      if (!count($result)) {
                          return $result;
                      }
                      
                      foreach ($result as $k => $v) {
                          $result[$k] = array_map(function ($v) {
                              $d = service('encrypter')->decrypt($v);
                              return $d !== false ? $d : $v;
                          }, $v);
                      }
                      
                      return $result;
    }

}
