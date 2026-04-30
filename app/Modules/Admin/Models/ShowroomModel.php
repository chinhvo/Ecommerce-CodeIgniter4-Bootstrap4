<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class ShowroomModel extends Model
{
    protected $table      = 'showrooms';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'name',
        'address',
        'google_map_location',
        'contact_phone',
        'email',
        'representative_person',
        'main_image',
        'additional_information',
        'is_active',
        'position',
    ];

    public function getShowrooms(): array
    {
        return $this->orderBy('position', 'ASC')->orderBy('id', 'DESC')->findAll();
    }

    public function getActiveShowrooms(): array
    {
        return $this->where('is_active', 1)->orderBy('position', 'ASC')->orderBy('id', 'DESC')->findAll();
    }

    public function getShowroom(int $id): ?array
    {
        return $this->find($id);
    }

    public function saveShowroom(array $data, int $id = 0): bool
    {
        if ($id > 0) {
            return (bool) $this->update($id, $data);
        }

        return (bool) $this->insert($data);
    }

    public function deleteShowroom(int $id): bool
    {
        return (bool) $this->delete($id);
    }
}
