<?php

namespace App\Modules\Admin\Controllers\TextualPages;

use App\Core\AdminController;

class TextualPages extends AdminController
{
    protected $textualPagesModel;

    public function __construct()
    {
        parent::__construct();
        $this->textualPagesModel = model(\App\Modules\Admin\Models\TextualPagesModel::class);
    }

    public function pageEdit($page = null)
    {
        $this->login_check();

        if ($page === null) {
            return redirect()->to('admin/pages');
        }

        $head = [
            'title'       => 'Administration - Pages Manage',
            'description' => '!',
            'keywords'    => '',
        ];

        $data['page'] = $this->textualPagesModel->getOnePageForEdit($page);

        if (empty($data['page'])) {
            return redirect()->to('admin/pages');
        }

        if ($this->request->getPost('updatePage')) {
            $this->textualPagesModel->setEditPageTranslations($this->request->getPost());
            $this->saveHistory('Page ' . $this->request->getPost('pageId') . ' updated!');
            return redirect()->to('admin/pageedit/' . $page);
        }

        echo view('_parts/header', $head);
        echo view('App\Modules\Admin\Views\textualpages\pageedit', $data);
        echo view('_parts/footer');

        $this->saveHistory('Edit page - ' . $page);
    }

    public function changePageStatus()
    {
        $this->login_check();

        $id     = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        $result = $this->textualPagesModel->changePageStatus($id, $status);

        echo $result ? '1' : '0';

        $this->saveHistory('Page status Changed');
    }
}
