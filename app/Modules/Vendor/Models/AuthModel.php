<?php
namespace App\Modules\Vendor\Models;

use CodeIgniter\Model;
use RuntimeException;

class AuthModel extends Model
{
    protected $table         = 'vendors';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['email', 'password'];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    /**
     * Registers a new vendor
     */
    public function registerVendor(array $post): void
    {
        $data = [
            'email'    => trim($post['u_email']),
            'password' => password_hash($post['u_password'], PASSWORD_DEFAULT),
        ];

        if (! $this->insert($data)) {
            log_message('error', print_r($this->errors(), true));
            throw new RuntimeException(lang('database_error'));
        }
    }

    /**
     * Counts vendors by email
     */
    public function countVendorsWithEmail(string $email): int
    {
        return $this->where('email', $email)->countAllResults();
    }

    /**
     * Checks if vendor exists and password is valid
     */
    public function checkVendorExists(array $post): bool
    {
        $vendor = $this->where('email', $post['u_email'])->first();

        if (empty($vendor) || ! password_verify($post['u_password'], $vendor['password'])) {
            return false;
        }

        return true;
    }

    /**
     * Updates vendor password and returns the new one in plain text
     */
    public function updateVendorPassword(string $email): string
    {
        $newPass = str_shuffle(bin2hex(random_bytes(4)));

        if (! $this->where('email', $email)->set([
            'password' => password_hash($newPass, PASSWORD_DEFAULT)
        ])->update()) {
            log_message('error', print_r($this->errors(), true));
            throw new RuntimeException(lang('database_error'));
        }

        return $newPass;
    }
}