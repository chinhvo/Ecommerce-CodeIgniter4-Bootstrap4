<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class AdminUsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    // Update this list to match your users table columns
    protected $allowedFields = [
        'username',
        'password',
        'email',
        'notify',
        'last_login',
    ];

    /**
     * CI3: deleteAdminUser($id)
     */
    public function deleteAdminUser(int $id): bool
    {
        try {
            return (bool) $this->delete($id);
        } catch (DatabaseException $e) {
            log_message('error', $e->getMessage());
            throw $e; // or return false
        }
    }

    /**
     * CI3: getAdminUsers($user = null)
     * - if numeric: where id
     * - if string : where username
     * - if null   : return all users
     */
    public function getAdminUsers($user = null)
    {
        if ($user !== null && is_numeric($user)) {
            return $this->where('id', (int) $user)->first();
        }

        if ($user !== null && is_string($user)) {
            return $this->where('username', $user)->first();
        }

        return $this->orderBy('id', 'DESC')->findAll();
    }

    /**
     * CI3: setAdminUser($post)
     * - if edit > 0: update
     * - else: insert
     * - keep md5() hashing for compatibility
     */
    public function setAdminUser(array $post, int $editId = 0): bool
    {
        // normalize to avoid trim(null) type error
        $password = (string) ($post['password'] ?? '');

        // remove keys not in table
        unset($post['id']); // your CI3 unset id/edit before update
        unset($post['edit']);

        // Handle password rule like CI3
        if ($editId > 0) {
            if (trim($password) === '') {
                unset($post['password']); // keep old password
            } else {
                $post['password'] = md5($password);
            }

            try {
                return (bool) $this->update($editId, $post);
            } catch (DatabaseException $e) {
                log_message('error', $e->getMessage());
                throw $e;
            }
        }

        // Insert
        $post['password'] = md5($password);

        try {
            return (bool) $this->insert($post);
        } catch (DatabaseException $e) {
            log_message('error', $e->getMessage());
            throw $e;
        }
    }
}
