<?php



namespace App\Controllers;
use App\Core\MyController;

class Page extends MyController
{
    protected $Public_model;

    public function __construct()
    {
        parent::__construct();
        $this->Public_model = model(\App\Models\PublicModel::class);
    }

    public function index($page = null)
    {
        $this->goOut($page);
        $page = $this->Public_model->getOnePage($page);
        $this->goOut($page);
        $data = array();
        $head = array();
        $head['title'] = $page['name'];
        $head['description'] = character_limiter(strip_tags(trim($page['content'])), 120);
        $head['keywords'] = str_replace(" ", ",", $page['name']);
        $data['content'] = $page['content'];
        $this->render('dynPage', $head, $data);
    }

    private function goOut($page)
    {
        if ($page == null) {
            redirect();
        }
    }

}
