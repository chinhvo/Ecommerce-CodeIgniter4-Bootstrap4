<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class VendorsModel extends Model
{
    protected $table      = 'vendors';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'email', 'phone']; // adjust to actual vendor fields

    public function getVendors(int $id = null)
    {
        $builder = $this->db->table($this->table);

        if (!is_null($id) && $id > 0) {
            $builder->where('id', $id);
        }

        return $builder->get()->getResultArray();
    }

    public function getVendorOrders(int $vendor_id): array
    {
        return $this->db->table('vendors')
            ->join('vendors_orders', 'vendors_orders.vendor_id = vendors.id')
            ->where('vendors.id', $vendor_id)
            ->get()
            ->getResultArray();
    }
}
