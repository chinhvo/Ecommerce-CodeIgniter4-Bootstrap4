<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use RuntimeException;

class EmailsModel extends Model
{
    protected $table      = 'subscribed';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function emailsCount(): int
    {
        return $this->countAll();
    }

    public function getSubscribedEmails(int $limit, int $offset = 0): array
    {
        return $this->orderBy('id', 'DESC')
                    ->findAll($limit, $offset);
    }

    public function deleteEmail(int $id): bool
    {
        if (!$this->delete($id)) {
            throw new RuntimeException(lang('database_error'));
        }
        return true;
    }
}