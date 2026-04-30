<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table      = 'sliders';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'name',
        'link',
        'image',
        'is_active',
        'active_from',
        'active_to',
        'position',
    ];

    /**
     * Get all sliders ordered by position.
     */
    public function getSliders(): array
    {
        return $this->orderBy('position', 'ASC')->orderBy('id', 'DESC')->findAll();
    }

    /**
     * Get a single slider by ID.
     */
    public function getSlider(int $id): ?array
    {
        return $this->find($id);
    }

    /**
     * Get sliders that are active today:
     *  - is_active = 1
     *  - active_from IS NULL OR active_from <= TODAY
     *  - active_to   IS NULL OR active_to   >= TODAY
     */
    public function getActiveSliders(): array
    {
        $today = date('Y-m-d');

        return $this
            ->where('is_active', 1)
            ->groupStart()
                ->where('active_from IS NULL', null, false)
                ->orWhere('active_from <=', $today)
            ->groupEnd()
            ->groupStart()
                ->where('active_to IS NULL', null, false)
                ->orWhere('active_to >=', $today)
            ->groupEnd()
            ->orderBy('position', 'ASC')
            ->findAll();
    }

    /**
     * Insert or update a slider.
     */
    public function saveSlider(array $data, int $id = 0): bool
    {
        if ($id > 0) {
            return (bool) $this->update($id, $data);
        }
        return (bool) $this->insert($data);
    }

    /**
     * Delete a slider by ID.
     */
    public function deleteSlider(int $id): bool
    {
        return (bool) $this->delete($id);
    }
}
