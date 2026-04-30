<?php

namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;
use App\Modules\Admin\Models\SliderModel;

class Sliders extends AdminController
{
    protected $sliderModel;

    private const UPLOAD_PATH = FCPATH . 'attachments/slider_images/';
    private const UPLOAD_URL  = 'attachments/slider_images/';

    public function __construct()
    {
        parent::__construct();
        $this->sliderModel = model(SliderModel::class);
        $this->ensureUploadDir();
    }

    public function index(int $editId = 0)
    {
        $this->login_check();

        $editSlider = null;
        if ($editId > 0) {
            $editSlider = $this->sliderModel->getSlider($editId);
        }

        $head = [
            'title'       => 'Administration - Sliders',
            'description' => '',
            'keywords'    => '',
        ];

        $data = [
            'sliders'    => $this->sliderModel->getSliders(),
            'editSlider' => $editSlider,
            'openModal'  => $editSlider !== null,
            'validation' => session('validation'),
        ];

        echo view('\App\Modules\Admin\Views\Settings\sliders', array_merge($data, $head));
        $this->saveHistory('View Sliders list');
    }

    public function save()
    {
        $this->login_check();

        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to('admin/sliders');
        }

        $editId = (int) ($this->request->getPost('id') ?? 0);

        $rules = [
            'name'        => 'required|max_length[200]',
            'link'        => 'permit_empty|max_length[500]',
            'is_active'   => 'required|in_list[0,1]',
            'active_from' => 'permit_empty|valid_date[Y-m-d]',
            'active_to'   => 'permit_empty|valid_date[Y-m-d]',
            'position'    => 'permit_empty|integer',
        ];

        // Image required only on insert (no existing record)
        if ($editId === 0) {
            $rules['image'] = 'uploaded[image]|max_size[image,4096]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif,image/webp]';
        } else {
            $rules['image'] = 'if_exist|max_size[image,4096]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif,image/webp]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $post = $this->request->getPost();

        $data = [
            'name'        => $post['name'],
            'link'        => $post['link'] ?? null,
            'is_active'   => (int) $post['is_active'],
            'active_from' => $post['active_from'] ?: null,
            'active_to'   => $post['active_to'] ?: null,
            'position'    => (int) ($post['position'] ?? 0),
        ];

        // Handle image upload
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            // Delete old image if editing
            if ($editId > 0) {
                $existing = $this->sliderModel->getSlider($editId);
                if (! empty($existing['image'])) {
                    $oldPath = FCPATH . $existing['image'];
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
            }

            $newName = $file->getRandomName();
            $file->move(self::UPLOAD_PATH, $newName);
            $data['image'] = self::UPLOAD_URL . $newName;
        }

        $this->sliderModel->saveSlider($data, $editId);

        $action = $editId > 0 ? 'Updated' : 'Created';
        $this->saveHistory($action . ' slider: ' . $data['name']);
        session()->setFlashdata('result', lang($editId > 0 ? 'slider_updated' : 'slider_saved'));

        return redirect()->to('admin/sliders');
    }

    public function delete(int $id)
    {
        $this->login_check();

        $slider = $this->sliderModel->getSlider($id);
        if ($slider) {
            // Remove image file
            if (! empty($slider['image'])) {
                $imagePath = FCPATH . $slider['image'];
                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }
            $this->sliderModel->deleteSlider($id);
            $this->saveHistory('Deleted slider: ' . $slider['name']);
        }

        session()->setFlashdata('result', lang('slider_deleted'));
        return redirect()->to('admin/sliders');
    }

    private function ensureUploadDir(): void
    {
        if (! is_dir(self::UPLOAD_PATH)) {
            $old = umask(0);
            mkdir(self::UPLOAD_PATH, 0775, true);
            umask($old);
        }
    }
}
