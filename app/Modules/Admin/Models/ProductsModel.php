<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'image', 'shop_categorie', 'quantity', 'in_slider', 'position', 
        'virtual_products', 'folder', 'brand_id', 'shopee_link', 'time', 'time_update', 'url', 'vendor_id', 'visibility'
    ];

    public function deleteProduct(int $id): void
    {
        $this->db->transBegin();

        if (!$this->db->table('products_translations')->where('for_id', $id)->delete()) {
            log_message('error', print_r($this->db->error(), true));
        }

        if (!$this->db->table('products')->where('id', $id)->delete()) {
            log_message('error', print_r($this->db->error(), true));
        }

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            throw new \RuntimeException(lang('database_error'));
        }

        $this->db->transCommit();
    }

    public function productsCount(string $search_title = null, int $category = null): int
    {
        $builder = $this->db->table('products')
            ->join('products_translations', 'products_translations.for_id = products.id', 'left')
            ->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);

        if ($search_title) {
            $builder->like('products_translations.title', $search_title);
        }
        if ($category) {
            $builder->where('shop_categorie', $category);
        }

        return $builder->countAllResults();
    }

    public function getProducts(int $limit, int $page, string $search_title = null, string $orderby = null, int $category = null, int $vendor = null)
    {
        $builder = $this->db->table('products')
            ->select('vendors.name as vendor_name, vendors.id as vendor_id, products.*, products_translations.title, products_translations.description, products_translations.price, products_translations.old_price, products_translations.abbr, products.url, products_translations.for_id, products_translations.basic_description')
            ->join('vendors', 'vendors.id = products.vendor_id', 'left')
            ->join('products_translations', 'products_translations.for_id = products.id', 'left')
            ->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);

        if ($search_title) {
            $builder->like('products_translations.title', $search_title);
        }

        if ($orderby) {
            [$col, $dir] = explode('=', $orderby);
            $builder->orderBy('products.' . $col, $dir);
        } else {
            $builder->orderBy('products.position', 'asc');
        }

        if ($category) {
            $builder->where('shop_categorie', $category);
        }
        if ($vendor) {
            $builder->where('vendor_id', $vendor);
        }

        return $builder->get($limit, $page)->getResult();
    }

    public function numShopProducts(): int
    {
        return $this->db->table('products')->countAllResults();
    }

    public function getOneProduct(int $id)
    {
        $builder = $this->db->table('products')
            ->select('vendors.name as vendor_name, vendors.id as vendor_id, products.*, products_translations.price')
            ->join('vendors', 'vendors.id = products.vendor_id', 'left')
            ->join('products_translations', 'products_translations.for_id = products.id', 'inner')
            ->where('products.id', $id)
            ->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);

        $query = $builder->get();

        return $query->getNumRows() > 0 ? $query->getRowArray() : false;
    }

    public function productStatusChange(int $id, int $to_status): bool
    {
        return $this->db->table('products')->where('id', $id)->update(['visibility' => $to_status]);
    }

    public function setProduct(array $post, int $id = 0): void
    {
        $post['brand_id'] = $post['brand_id'] ?? null;
        $post['virtual_products'] = $post['virtual_products'] ?? null;

        $this->db->transBegin();
        $is_update = $id > 0;

        if ($is_update) {
            if (!$this->db->table('products')->where('id', $id)->update([
                'image'            => $post['image'] ?? $_POST['old_image'],
                'shop_categorie'   => $post['shop_categorie'],
                'quantity'         => $post['quantity'],
                'in_slider'        => $post['in_slider'],
                'position'         => $post['position'],
                'virtual_products' => $post['virtual_products'],
                'brand_id'         => $post['brand_id'],
                'time_update'      => time()
            ])) {
                log_message('error', print_r($this->db->error(), true));
            }
        } else {
            // Determine translation index for default language
            $myTranslationNum = array_search(MY_DEFAULT_LANGUAGE_ABBR, $_POST['translations'], true);

            if (!$this->db->table('products')->insert([
                'image'            => $post['image'],
                'shop_categorie'   => $post['shop_categorie'],
                'quantity'         => $post['quantity'],
                'in_slider'        => $post['in_slider'],
                'position'         => $post['position'],
                'virtual_products' => $post['virtual_products'],
                'folder'           => $post['folder'],
                'brand_id'         => $post['brand_id'],
                'time'             => time()
            ])) {
                log_message('error', print_r($this->db->error(), true));
            }

            $id = $this->db->insertID();

            if (!$this->db->table('products')->where('id', $id)->update([
                'url' => except_letters($_POST['title'][$myTranslationNum]) . '_' . $id
            ])) {
                log_message('error', print_r($this->db->error(), true));
            }
        }

        $this->setProductTranslation($post, $id, $is_update);

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            log_message('error', print_r($this->db->error(), true));
        }

        $this->db->transCommit();
    }

    private function setProductTranslation(array $post, int $id, bool $is_update): void
    {
        $current_trans = $this->getTranslations($id);

        foreach ($post['translations'] as $i => $abbr) {
            $price = preg_replace("/[^0-9,.]/", "", str_replace(',', '.', str_replace(' ', '', $post['price'][$i])));
            $old_price = preg_replace("/[^0-9,.]/", "", str_replace(',', '.', str_replace(' ', '', $post['old_price'][$i])));

            $data = [
                'title'             => str_replace('"', "'", $post['title'][$i]),
                'basic_description' => $post['basic_description'][$i],
                'description'       => $post['description'][$i],
                'price'             => $price,
                'old_price'         => $old_price,
                'abbr'              => $abbr,
                'for_id'            => $id
            ];

            if ($is_update && isset($current_trans[$abbr])) {
                unset($data['for_id'], $data['abbr']);
                if (!$this->db->table('products_translations')->where('abbr', $abbr)->where('for_id', $id)->update($data)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            } else {
                if (!$this->db->table('products_translations')->insert($data)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
        }
    }

    public function getTranslations(int $id): array
    {
        $result = $this->db->table('products_translations')->where('for_id', $id)->get()->getResult();
        $arr = [];

        foreach ($result as $row) {
            $arr[$row->abbr] = [
                'title'             => $row->title,
                'basic_description' => $row->basic_description,
                'description'       => $row->description,
                'price'             => $row->price,
                'old_price'         => $row->old_price
            ];
        }

        return $arr;
    }
}