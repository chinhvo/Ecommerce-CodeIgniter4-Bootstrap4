<?php

namespace App\Models;

use CodeIgniter\Model;
use RuntimeException;

class ContactMessagesModel extends Model
{
    protected $table            = 'contact_messages';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'subject',
        'message',
        'ip_address',
        'user_agent',
    ];

    public function messagesCount(): int
    {
        return $this->countAll();
    }

    public function getMessages(int $limit, int $offset = 0): array
    {
        return $this->orderBy('id', 'DESC')->findAll($limit, $offset);
    }

    public function saveMessage(array $data): bool
    {
        return $this->insert($data) !== false;
    }

    public function deleteMessage(int $id): bool
    {
        if (!$this->delete($id)) {
            throw new RuntimeException(lang('database_error'));
        }

        return true;
    }
}
