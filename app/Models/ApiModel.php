<?php
namespace App\Models;

use CodeIgniter\Model;

class ApiModel extends Model
{

    public function getProducts($lang)
    {
        $builder = $this->db->table('products');
        $builder->select('
        vendors.name as vendor_name,
        vendors.id as vendor_id,
        products.id as product_id,
        products.image as product_image,
        products.time as product_time_created,
        products.time_update as product_time_updated,
        products.visibility as product_visibility,
        products.shop_categorie as product_category,
        products.quantity as product_quantity_available,
        products.procurement as product_procurement,
        products.url as product_url,
        products.virtual_products,
        products.brand_id as product_brand_id,
        products.position as product_position,
        products_translations.title,
        products_translations.description,
        products_translations.price,
        products_translations.old_price,
        products_translations.basic_description');
        $builder->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $builder->where('products_translations.abbr', $lang);

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getProduct($lang, $id)
    {
        $builder = $this->db->table('products');

        $builder->select('
        vendors.name as vendor_name,
        vendors.id as vendor_id,
        products.id as product_id,
        products.image as product_image,
        products.time as product_time_created,
        products.time_update as product_time_updated,
        products.visibility as product_visibility,
        products.shop_categorie as product_category,
        products.quantity as product_quantity_available,
        products.procurement as product_procurement,
        products.url as product_url,
        products.virtual_products,
        products.brand_id as product_brand_id,
        products.position as product_position,
        products_translations.title,
        products_translations.description,
        products_translations.price,
        products_translations.old_price,
        products_translations.basic_description
    ');

        $builder->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $builder->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $builder->where('products_translations.abbr', $lang);
        $builder->where('products.id', $id);
        $builder->limit(1);

        $query = $builder->get();
        return $query->getRowArray();
    }



    private function setProductTranslation($post, $id)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id);
        foreach ($post['translations'] as $abbr) {
            $arr = array();
            $emergency_insert = false;
            if (! isset($current_trans[$abbr])) {
                $emergency_insert = true;
            }
            $post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
            $post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
            $post['price'][$i] = str_replace(',', '', $post['price'][$i]);
            $arr = array(
                'title' => $post['title'][$i],
                'basic_description' => $post['basic_description'][$i],
                'description' => $post['description'][$i],
                'price' => $post['price'][$i],
                'old_price' => $post['old_price'][$i],
                'abbr' => $abbr,
                'for_id' => $id
            );

            if (! $this->db->insert('products_translations', $arr)) {
                log_message('error', print_r($this->db->error(), true));
            }
            $i ++;
        }
    }
    
    public function setProduct(array $post): bool
    {
        $db = \Config\Database::connect();
        
        if (! isset($post['brand_id'])) {
            $post['brand_id'] = null;
        }
        if (! isset($post['virtual_products'])) {
            $post['virtual_products'] = null;
        }
        
        $db->transBegin();
        
        // Find index for default language
        $i = 0;
        foreach ($post['translations'] as $translation) {
            if ($translation === MY_DEFAULT_LANGUAGE_ABBR) {
                $myTranslationNum = $i;
            }
            $i++;
        }
        
        // Insert into products
        $insertData = [
            'image'            => $post['image'],
            'shop_categorie'   => $post['shop_categorie'],
            'quantity'         => $post['quantity'],
            'in_slider'        => $post['in_slider'],
            'position'         => $post['position'],
            'virtual_products' => $post['virtual_products'],
            'folder'           => time(),
            'brand_id'         => $post['brand_id'],
            'time'             => time()
        ];
        
        if (! $db->table('products')->insert($insertData)) {
            log_message('error', print_r($db->error(), true));
        }
        
        $id = $db->insertID();
        
        // Update the URL
        $urlData = [
            'url' => vnToStr(except_letters($post['title'][$myTranslationNum])) . '_' . $id
        ];
        
        if (! $db->table('products')->where('id', $id)->update($urlData)) {
            log_message('error', print_r($db->error(), true));
        }
        
        // Save translations
        $this->setProductTranslation($post, $id);
        
        if ($db->transStatus() === false) {
            $db->transRollback();
            return false;
        }
        
        $db->transCommit();
        return true;
    }
    
    private function getTranslations(int $id): array
    {
        $db = \Config\Database::connect();
        
        $query = $db->table('products_translations')
        ->where('for_id', $id)
        ->get();
        
        $arr = [];
        foreach ($query->getResult() as $row) {
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

    public function deleteProduct(int $id): void
    {
        $db = \Config\Database::connect();
        
        $db->transBegin();
        
        // Delete translations
        if (! $db->table('products_translations')->where('for_id', $id)->delete()) {
            log_message('error', print_r($db->error(), true));
        }
        
        // Delete main product
        if (! $db->table('products')->where('id', $id)->delete()) {
            log_message('error', print_r($db->error(), true));
        }
        
        if ($db->transStatus() === false) {
            $db->transRollback();
        } else {
            $db->transCommit();
        }
    }
}
