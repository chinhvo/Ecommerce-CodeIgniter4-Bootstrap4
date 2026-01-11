<?php
namespace App\Modules\Admin\Controllers\Settings;

use App\Core\AdminController;

class History extends AdminController
{
    private $num_rows = 20;
    protected $History_model;

    public function __construct()
    {
        parent::__construct();
        $this->History_model = model(\App\Modules\Admin\Models\HistoryModel::class);
    }

    public function index($page = 0)
    {
        $this->login_check();

        $head = [
            'title'       => 'Administration - History',
            'description' => '!',
            'keywords'    => ''
        ];

        $rowscount = $this->History_model->historyCount();

        $data = [
            'actions'           => $this->History_model->getHistory($this->num_rows, $page),
            'links_pagination'  => pagination('admin/history', $rowscount, $this->num_rows, 3),
            'history'           => $this->history // inherited from AdminController
        ];

        echo view('\App\Modules\Admin\Views\settings\history', array_merge($data, $head));
        

        if ($page == 0) {
            $this->saveHistory('Go to History');
        }
    }
}