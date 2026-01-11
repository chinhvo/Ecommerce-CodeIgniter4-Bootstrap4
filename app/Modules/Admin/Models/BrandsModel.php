<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use RuntimeException;

class BrandsModel extends Model
{
    protected $table         = 'brands';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name'];
    protected $returnType    = 'array';

    /**
     * Get all brands
     */
    public function getBrands(): array
    {
        return $this->findAll();
    }

    /**
     * Insert a new brand
     *
     * @param string $name
     * @return int Inserted ID
     * @throws RuntimeException
     */
    public function setBrand(string $name): int
    {
        if (! $this->insert(['name' => $name])) {
            log_message('error', print_r($this->errors(), true));
            throw new RuntimeException(lang('database_error'));
        }
        return $this->getInsertID();
    }

    /**
     * Delete a brand by ID
     *
     * @param int $id
     * @throws RuntimeException
     */
    public function deleteBrand(int $id): void
    {
        if (! $this->delete($id)) {
            log_message('error', print_r($this->errors(), true));
            throw new RuntimeException(lang('database_error'));
        }
    }
}
