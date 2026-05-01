<?php

namespace App\Modules\Admin\Controllers\Ecommerce;

use App\Core\AdminController;

class ShopCategories extends AdminController
{
    private $num_rows = 10;
    private $segment = 3;
    protected $Categories_model;
    protected $Languages_model;
    protected $session;

    public function __construct()
    {
        parent::__construct();
        $this->Categories_model = model(\App\Modules\Admin\Models\CategoriesModel::class);
        $this->Languages_model  = model(\App\Modules\Admin\Models\LanguagesModel::class);
        $this->session          = session();
    }

    public function index($page = 0)
    {
        $this->login_check();

        $head = [
            'title'       => lang('admin_shop_categories_page_title'),
            'description' => '!',
            'keywords'    => ''
        ];

        $data['shop_categories'] = $this->Categories_model->getShopCategories($this->num_rows, $page);
        $data['languages']       = $this->Languages_model->getLanguages();
        $rowscount               = $this->Categories_model->categoriesCount();
        $data['links_pagination'] = pagination('admin/shopcategories', $rowscount, $this->num_rows, $page, $this->segment);

        // Delete
        if ($this->request->getGet('delete')) {
            $this->saveHistory(lang('admin_history_delete_shop_category'));
            $this->Categories_model->deleteShopCategorie($this->request->getGet('delete'));
            $this->session->setFlashdata('result_delete', lang('admin_shop_category_deleted'));
            return redirect()->to('admin/shopcategories');
        }

        // Add
        if ($this->request->getPost('submit')) {
            $this->Categories_model->setShopCategorie($this->request->getPost());
            $this->session->setFlashdata('result_add', lang('admin_shop_category_added'));
            return redirect()->to('admin/shopcategories');
        }

        // Edit subcategory
        if ($this->request->getPost('editSubId')) {
            $result = $this->Categories_model->editShopCategorieSub($this->request->getPost());
            if ($result === true) {
                $this->session->setFlashdata('result_add', lang('admin_shop_category_subcategory_changed'));
                $this->saveHistory(lang('admin_history_change_subcategory_for_category_id') . ' - ' . $this->request->getPost('editSubId'));
            } else {
                $this->session->setFlashdata('result_add', lang('admin_shop_category_change_problem'));
            }
            return redirect()->to('admin/shopcategories');
        }

        echo view('\App\Modules\Admin\Views\Ecommerce\shopcategories', array_merge($data, $head));

        $this->saveHistory(lang('admin_history_go_to_shop_categories'));
    }

    /**
     * Called from AJAX
     */
    public function editShopCategorie()
    {
        $this->login_check();
        $post = $this->request->getPost();
        $this->Categories_model->editShopCategorie($post);

        $isIconEdit = (($post['edit_type'] ?? 'name') === 'icon');
        $editedValue = $isIconEdit ? (string) ($post['icon'] ?? '') : (string) ($post['name'] ?? '');
        $this->saveHistory(lang('admin_history_edit_shop_category_to') . ' ' . $editedValue);
    }

    /**
     * Called from AJAX
     */
    public function changePosition()
    {
        $this->login_check();
        $post = $this->request->getPost();
        $this->Categories_model->editShopCategoriePosition($post);
        $this->saveHistory(lang('admin_history_edit_shop_category_position') . ' ' . ($post['name'] ?? ''));
    }
}
