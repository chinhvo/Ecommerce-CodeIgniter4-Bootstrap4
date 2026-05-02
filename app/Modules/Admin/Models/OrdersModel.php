<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use Config\Services;

class OrdersModel extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['processed', 'viewed', 'products', 'discount_code'];
    protected $returnType = 'array';

    protected $encryption;

    public function __construct()
    {
        parent::__construct();
        $this->encryption = Services::encrypter(); // CI4 way
    }

    public function ordersCount(bool $onlyNew = false): int
    {
        $builder = $this->db->table('orders');
        if ($onlyNew) {
            $builder->where('viewed', 0);
        }
        return $builder->countAllResults();
    }

    public function orders(int $limit, int $page, ?string $order_by = null): array
    {
        $builder = $this->db->table('orders')
            ->select('orders.*, orders_clients.first_name, orders_clients.last_name, orders_clients.email, orders_clients.phone, 
                      orders_clients.address, orders_clients.city, orders_clients.post_code, orders_clients.notes,
                      discount_codes.type as discount_type, discount_codes.amount as discount_amount')
            ->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner')
            ->join('discount_codes', 'discount_codes.code = orders.discount_code', 'left');

        $builder->orderBy($order_by ?? 'orders.id', 'DESC');

        $result = $builder->get($limit, $page)->getResultArray();

        if (!count($result)) {
            return $result;
        }

        // Decrypt only customer fields that are stored encrypted.
        $encryptedFields = [
            'first_name',
            'last_name',
            'email',
            'phone',
            'address',
            'city',
            'post_code',
            'notes',
        ];

        foreach ($result as $k => $row) {
            foreach ($encryptedFields as $field) {
                if (!array_key_exists($field, $row) || !is_string($row[$field]) || $row[$field] === '') {
                    continue;
                }

                $row[$field] = $this->decryptClientValue($row[$field]);
            }

            $result[$k] = $row;
        }

        return $result;
    }

    private function decryptClientValue(string $value): string
    {
        try {
            $decrypted = $this->encryption->decrypt($value);
            if (is_string($decrypted) && $decrypted !== '') {
                return $decrypted;
            }
        } catch (\Throwable $e) {
            // Try base64-wrapped ciphertext next.
        }

        $decoded = base64_decode($value, true);
        if ($decoded !== false && $decoded !== '') {
            try {
                $decrypted = $this->encryption->decrypt($decoded);
                if (is_string($decrypted) && $decrypted !== '') {
                    return $decrypted;
                }
            } catch (\Throwable $e) {
                // Keep original value below.
            }
        }

        return $value;
    }

    public function changeOrderStatus(int $id, int $to_status): bool
    {
        $row = $this->db->table('orders')
            ->select('processed')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$row || $row['processed'] == $to_status) {
            return false;
        }

        $updated = $this->db->table('orders')
            ->where('id', $id)
            ->update(['processed' => $to_status, 'viewed' => 1]);

        if ($updated) {
            $this->manageQuantitiesAndProcurement($id, $to_status, $row['processed']);
        }

        return $updated;
    }

    private function manageQuantitiesAndProcurement(int $id, int $to_status, int $current): void
    {
        $operator = $operator_pro = null;

        if (($to_status == 0 || $to_status == 2) && $current == 1) {
            $operator = '+';
            $operator_pro = '-';
        }
        if ($to_status == 1) {
            $operator = '-';
            $operator_pro = '+';
        }

        $order = $this->db->table('orders')
            ->select('products')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        $products = unserialize($order['products']);

        foreach ($products as $product) {
            if (!is_numeric($product['product_quantity']) || (int)$product['product_info']['id'] < 1) {
                continue;
            }

            if ($operator) {
                $this->db->query("UPDATE products SET quantity = quantity {$operator} ? WHERE id = ?", [
                    $product['product_quantity'],
                    (int)$product['product_info']['id']
                ]);
            }

            if ($operator_pro) {
                $this->db->query("UPDATE products SET procurement = procurement {$operator_pro} ? WHERE id = ?", [
                    $product['product_quantity'],
                    (int)$product['product_info']['id']
                ]);
            }
        }
    }

    public function setBankAccountSettings(array $post): bool
    {
        $existing = $this->db->table('bank_accounts')->get()->getRowArray();
        $post['id'] = $existing['id'] ?? 1;
        unset($post["csrf_test_name"]);
        return $this->db->table('bank_accounts')->replace($post);
    }

    public function getBankAccountSettings(): ?array
    {
        return $this->db->table('bank_accounts')->get(1)->getRowArray();
    }

    public function deleteOrder(int $id): void
    {
        $this->db->transStart();

        $this->db->table('orders')->delete(['id' => $id]);
        $this->db->table('orders_clients')->delete(['for_id' => $id]);

        $this->db->transComplete();

        if (!$this->db->transStatus()) {
            throw new \RuntimeException(lang('database_error'));
        }
    }
}
