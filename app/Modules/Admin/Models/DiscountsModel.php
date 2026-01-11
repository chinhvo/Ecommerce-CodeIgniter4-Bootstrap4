<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use RuntimeException;

class DiscountsModel extends Model
{
    protected $table      = 'discount_codes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'type', 'code', 'amount', 'status',
        'valid_from_date', 'valid_to_date'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function getDiscountCodeInfo(int $id): ?array
    {
        return $this->find($id);
    }

    public function changeCodeDiscountStatus(int $codeId, int $toStatus): bool
    {
        if (!$this->update($codeId, ['status' => $toStatus])) {
            throw new RuntimeException(lang('database_error'));
        }
        return true;
    }

    public function discountCodesCount(): int
    {
        return $this->countAll();
    }

    public function getDiscountCodes(int $limit, int $offset = 0): array
    {
        return $this->orderBy('id', 'DESC')
                    ->findAll($limit, $offset);
    }

    public function setDiscountCode(array $post): bool
    {
        $data = [
            'type'            => $post['type'],
            'code'            => trim($post['code']),
            'amount'          => $post['amount'],
            'valid_from_date' => strtotime($post['valid_from_date']),
            'valid_to_date'   => strtotime($post['valid_to_date']),
            'status'          => $post['status'] ?? 1
        ];

        if (!$this->insert($data)) {
            throw new RuntimeException(lang('database_error'));
        }
        return true;
    }

    public function updateDiscountCode(array $post): bool
    {
        $data = [
            'type'            => $post['type'],
            'code'            => trim($post['code']),
            'amount'          => $post['amount'],
            'valid_from_date' => strtotime($post['valid_from_date']),
            'valid_to_date'   => strtotime($post['valid_to_date']),
        ];

        if (!$this->update($post['update'], $data)) {
            throw new RuntimeException(lang('database_error'));
        }
        return true;
    }

    public function discountCodeTakenCheck(array $post): bool
    {
        $builder = $this->where('code', $post['code']);

        if (!empty($post['update'])) {
            $builder->where('id !=', $post['update']);
        }

        return $builder->countAllResults() === 0;
    }
}