<?php
namespace App\Modules\Vendor\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table         = 'products';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'image', 'shop_categorie', 'quantity', 'position',
        'brand_id', 'folder', 'vendor_id', 'time', 'url'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getOneProduct(int $id, int $vendor_id)
    {
        return $this->where('id', $id)
                    ->where('vendor_id', $vendor_id)
                    ->get()
                    ->getRowArray();
    }

    public function setProduct(array $post, int $id = 0): bool
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $is_update = false;

        if ($id > 0) {
            $is_update = true;
            $data = [
                'image'         => $post['image'] ?? ($post['old_image'] ?? null),
                'shop_categorie'=> $post['shop_categorie'],
                'quantity'      => $post['quantity'],
                'position'      => $post['position'],
                'brand_id'      => $post['brand_id'] ?? null,
                'time_update'   => time()
            ];

            if (! $this->where('id', $id)
                       ->where('vendor_id', $post['vendor_id'])
                       ->set($data)
                       ->update()) {
                log_message('error', print_r($db->error(), true));
            }
        } 
        else {
            // Detect default language translation index
            $myTranslationNum = array_search(MY_DEFAULT_LANGUAGE_ABBR, $post['translations'], true);

            if (! $this->insert([
                'image'          => $post['image'],
                'shop_categorie' => $post['shop_categorie'],
                'quantity'       => $post['quantity'],
                'position'       => $post['position'],
                'brand_id'       => $post['brand_id'],
                'folder'         => $post['folder'],
                'vendor_id'      => $post['vendor_id'],
                'time'           => time()
            ])) {
                log_message('error', print_r($db->error(), true));
            }

            $id = $this->getInsertID();

            // Set product URL
            if (! $this->update($id, [
                'url' => except_letters($post['title'][$myTranslationNum]) . '_' . $id
            ])) {
                log_message('error', print_r($db->error(), true));
            }
        }

        $this->setProductTranslation($post, $id, $is_update);

        $db->transComplete();

        if ($db->transStatus() === false) {
            show_error(lang('database_error'));
            return false;
        }

        return true;
    }

    private function setProductTranslation(array $post, int $id, bool $is_update = false)
    {
        $translations = $this->getTranslations($id);
        $db = \Config\Database::connect();

        foreach ($post['translations'] as $i => $abbr) {
            $emergency_insert = ! isset($translations[$abbr]);

            $arr = [
                'title'       => str_replace('"', "'", $post['title'][$i]),
                'description' => $post['description'][$i],
                'price'       => str_replace([',', ' '], '', $post['price'][$i]),
                'old_price'   => $post['old_price'][$i],
                'abbr'        => $abbr,
                'for_id'      => $id
            ];

            if ($is_update && ! $emergency_insert) {
                unset($arr['for_id'], $arr['abbr']);
                if (! $db->table('products_translations')
                         ->where('abbr', $abbr)
                         ->where('for_id', $id)
                         ->update($arr)) {
                    log_message('error', print_r($db->error(), true));
                }
            } 
            else {
                if (! $db->table('products_translations')->insert($arr)) {
                    log_message('error', print_r($db->error(), true));
                }
            }
        }
    }

    public function getTranslations(int $id): array
    {
        $db = \Config\Database::connect();
        $query = $db->table('products_translations')->where('for_id', $id)->get();

        $arr = [];
        foreach ($query->getResult() as $row) {
            $arr[$row->abbr] = [
                'title'       => $row->title,
                'description' => $row->description,
                'price'       => $row->price,
                'old_price'   => $row->old_price
            ];
        }

        return $arr;
    }

    public function getProducts(int $limit, int $page, int $vendor_id)
    {
        return $this->select('products.*, products_translations.title, products_translations.description, products_translations.price')
                    ->join('products_translations', 'products_translations.for_id = products.id', 'left')
                    ->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR)
                    ->where('vendor_id', $vendor_id)
                    ->orderBy('products.position', 'ASC')
                    ->findAll($limit, $page);
    }

    public function productsCount(int $vendor_id): int
    {
        return $this->where('vendor_id', $vendor_id)->countAllResults();
    }

    public function deleteProduct(int $id, int $vendor_id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        if (! $this->where('id', $id)
                   ->where('vendor_id', $vendor_id)
                   ->delete()) {
            log_message('error', print_r($db->error(), true));
        } else {
            if (! $db->table('products_translations')->where('for_id', $id)->delete()) {
                log_message('error', print_r($db->error(), true));
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            show_error(lang('database_error'));
        }
    }
}