<?php
namespace App\Modules\Vendor\Models;

use CodeIgniter\Model;

class VendorProfileModel extends Model
{
    protected $table      = 'vendors';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'url', 'email', 'password'];

    public function getVendorInfoFromEmail(string $email): ?array
    {
        return $this->where('email', $email)
                    ->get()
                    ->getRowArray();
    }

    public function getVendorByUrlAddress(string $urlAddr): ?array
    {
        return $this->where('url', $urlAddr)
                    ->get()
                    ->getRowArray();
    }

    public function saveNewVendorDetails(array $post, int $vendor_id): bool
    {
        return $this->update($vendor_id, [
            'name' => $post['vendor_name'],
            'url'  => $post['vendor_url']
        ]);
    }

    public function isVendorUrlFree(string $vendorUrl): bool
    {
        return $this->where('url', $vendorUrl)
                    ->countAllResults() === 0;
    }

    public function getOrdersByMonth(int $vendor_id): array
    {
        $builder = $this->db->table('vendors_orders');
        $builder->select('YEAR(FROM_UNIXTIME(date)) as year, MONTH(FROM_UNIXTIME(date)) as month, COUNT(id) as num')
                ->where('vendor_id', $vendor_id)
                ->groupBy(['YEAR(FROM_UNIXTIME(date))', 'MONTH(FROM_UNIXTIME(date))'])
                ->orderBy('year, month', 'ASC');
        
        $result = $builder->get()->getResultArray();

        $orders = [];
        $years  = [];

        if (!empty($result)) {
            foreach ($result as $res) {
                if (!isset($orders[$res['year']])) {
                    for ($i = 1; $i <= 12; $i++) {
                        $orders[$res['year']][$i] = 0;
                    }
                }
                $years[] = $res['year'];
                $orders[$res['year']][$res['month']] = $res['num'];
            }
        }

        return [
            'years'  => !empty($years) ? array_unique($years) : [],
            'orders' => !empty($orders) ? $orders : [],
        ];
    }
}