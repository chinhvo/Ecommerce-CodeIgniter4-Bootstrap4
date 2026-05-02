<?php
namespace App\Modules\Vendor\Models;
use Config\Services;
use CodeIgniter\Model;
use CodeIgniter\Encryption\Encryption;

class OrdersModel extends Model
{
    protected $table         = 'vendors_orders';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['processed', 'viewed'];
    protected $returnType    = 'array';

    protected $encryption;

    public function __construct()
    {
        parent::__construct();
        $this->encryption = Services::encrypter(); // CI4 way
    }

    /**
     * Count total orders for a vendor
     */
    public function ordersCount(int $vendor_id): int
    {
        return $this->where('vendor_id', $vendor_id)->countAllResults();
    }

    /**
     * Get paginated orders with client & discount info
     */
    public function orders(int $limit, int $page, int $vendor_id): array
    {
        $builder = $this->select(
            'vendors_orders.*, 
            vendors_orders_clients.first_name,
            vendors_orders_clients.last_name,
            vendors_orders_clients.email,
            vendors_orders_clients.phone,
            vendors_orders_clients.address,
            vendors_orders_clients.city,
            vendors_orders_clients.post_code,
            vendors_orders_clients.notes,
            discount_codes.type as discount_type, 
            discount_codes.amount as discount_amount'
        )
        ->join('vendors_orders_clients', 'vendors_orders_clients.for_id = vendors_orders.id', 'inner')
        ->join('discount_codes', 'discount_codes.code = vendors_orders.discount_code', 'left')
        ->where('vendor_id', $vendor_id)
        ->orderBy('vendors_orders.id', 'DESC')
        ->limit($limit, $page);

        $result = $builder->get()->getResultArray();

        if (empty($result)) {
            return [];
        }

        // Attempt to decrypt each field where possible
        foreach ($result as $k => $row) {
            $result[$k] = array_map(function ($value) {
                $decrypted = $this->encryption->decrypt($value);
                return $decrypted !== false ? $decrypted : $value;
            }, $row);
        }

        return $result;
    }

    /**
     * Change order status if different from current
     */
    public function changeOrderStatus(int $id, string $to_status): bool
    {
        $order = $this->select('processed')->find($id);

        if (! $order) {
            return false;
        }

        if ($order['processed'] !== $to_status) {
            return $this->update($id, [
                'processed' => $to_status,
                'viewed'    => '1',
            ]);
        }

        return false;
    }
}