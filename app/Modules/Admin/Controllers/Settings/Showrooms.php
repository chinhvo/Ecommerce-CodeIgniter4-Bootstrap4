<?php

namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;
use App\Modules\Admin\Models\ShowroomModel;

class Showrooms extends AdminController
{
    protected $showroomModel;

    private const UPLOAD_PATH = FCPATH . 'attachments/showrooms/';
    private const UPLOAD_URL  = 'attachments/showrooms/';

    public function __construct()
    {
        parent::__construct();
        $this->showroomModel = model(ShowroomModel::class);
        $this->ensureUploadDir();
    }

    public function index(int $editId = 0)
    {
        $this->login_check();

        $editShowroom = null;
        if ($editId > 0) {
            $editShowroom = $this->showroomModel->getShowroom($editId);
        }

        $head = [
            'title'       => 'Administration - Showrooms',
            'description' => '',
            'keywords'    => '',
        ];

        $data = [
            'showrooms'    => $this->showroomModel->getShowrooms(),
            'editShowroom' => $editShowroom,
            'openModal'    => $editShowroom !== null,
            'validation'   => session('validation'),
        ];

        echo view('\App\Modules\Admin\Views\Settings\showrooms', array_merge($data, $head));
        $this->saveHistory('View Showrooms list');
    }

    public function save()
    {
        $this->login_check();

        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to('admin/showrooms');
        }

        $editId = (int) ($this->request->getPost('id') ?? 0);

        $rules = [
            'name'                   => 'required|max_length[200]',
            'address'                => 'required|max_length[500]',
            'google_map_location'    => 'permit_empty|max_length[1000]',
            'contact_phone'          => 'permit_empty|max_length[120]',
            'email'                  => 'permit_empty|valid_email|max_length[190]',
            'representative_person'  => 'permit_empty|max_length[190]',
            'additional_information' => 'permit_empty',
            'is_active'              => 'required|in_list[0,1]',
            'position'               => 'permit_empty|integer',
        ];

        $rules['main_image'] = 'if_exist|max_size[main_image,4096]|is_image[main_image]|mime_in[main_image,image/jpg,image/jpeg,image/png,image/gif,image/webp]';

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $post = $this->request->getPost();

        $data = [
            'name'                   => $post['name'],
            'address'                => $post['address'],
            'google_map_location'    => $post['google_map_location'] ?: null,
            'contact_phone'          => $post['contact_phone'] ?: null,
            'email'                  => $post['email'] ?: null,
            'representative_person'  => $post['representative_person'] ?: null,
            'additional_information' => $post['additional_information'] ?: null,
            'is_active'              => (int) $post['is_active'],
            'position'               => (int) ($post['position'] ?? 0),
        ];

        $file = $this->request->getFile('main_image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            if ($editId > 0) {
                $existing = $this->showroomModel->getShowroom($editId);
                if (! empty($existing['main_image'])) {
                    $oldPath = FCPATH . $existing['main_image'];
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
            }

            $newName = $file->getRandomName();
            $file->move(self::UPLOAD_PATH, $newName);
            $data['main_image'] = self::UPLOAD_URL . $newName;
        }

        $this->showroomModel->saveShowroom($data, $editId);

        $action = $editId > 0 ? 'Updated' : 'Created';
        $this->saveHistory($action . ' showroom: ' . $data['name']);
        session()->setFlashdata('result', lang($editId > 0 ? 'showroom_updated' : 'showroom_saved'));

        return redirect()->to('admin/showrooms');
    }

    public function delete(int $id)
    {
        $this->login_check();

        $showroom = $this->showroomModel->getShowroom($id);
        if ($showroom) {
            if (! empty($showroom['main_image'])) {
                $imagePath = FCPATH . $showroom['main_image'];
                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }

            $this->showroomModel->deleteShowroom($id);
            $this->saveHistory('Deleted showroom: ' . $showroom['name']);
        }

        session()->setFlashdata('result', lang('showroom_deleted'));
        return redirect()->to('admin/showrooms');
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
