<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use RuntimeException;

class HistoryModel extends Model
{
    protected $table      = 'history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['activity', 'username', 'time'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function historyCount(): int
    {
        return $this->countAll();
    }

    public function getHistory(int $limit, int $offset = 0): array
    {
        return $this->orderBy('id', 'DESC')
                    ->findAll($limit, $offset);
    }

    public function setHistory(string $activity, string $user): bool
    {
        $data = [
            'activity' => $activity,
            'username' => $user,
            'time'     => time(),
        ];

        if (!$this->insert($data)) {
            throw new RuntimeException(lang('database_error'));
        }
        return true;
    }
}