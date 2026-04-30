<?php


namespace App\Controllers;
use App\Core\BlogType;
use App\Core\MyController;

class Blog extends MyController
{
    protected $db;
    protected $Public_model;
    protected $Blog_model;

    private $num_rows = 20;
    
    /**
     * Blog archives data
     *
     * @var	array|bool
     */
    public $arhives;

    public function __construct()
    {
        parent::__construct();
        $this->Public_model = model(\App\Models\PublicModel::class);
        $this->Blog_model = model(\App\Modules\Admin\Models\BlogModel::class);
        if (!in_array('blog', $this->nonDynPages)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        helper('pagination');
        $this->arhives = $this->Public_model->getArchives();
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('blog');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = $head['title'] !== null ? str_replace(" ", ",", $head['title']) : '';
        if (isset($_GET['find'])) {
            $find = $_GET['find'];
        } else {
            $find = null;
        }
        if (isset($_GET['from']) && isset($_GET['to'])) {
            $month = $_GET;
        } else {
            $month = null;
        }
        $blogType = isset($_GET['type']) && is_numeric($_GET['type'])
            ? BlogType::normalize($_GET['type'])
            : null;

        $paginationBase = 'blog';
        $queryArgs = [];
        if (!empty($find)) {
            $queryArgs['find'] = $find;
        }
        if ($month !== null) {
            $queryArgs['from'] = (int) $month['from'];
            $queryArgs['to'] = (int) $month['to'];
        }
        if ($blogType !== null) {
            $queryArgs['type'] = $blogType;
        }
        if (!empty($queryArgs)) {
            $paginationBase .= '?' . http_build_query($queryArgs);
        }

        $data['posts'] = $this->Public_model->getPosts($this->num_rows, $page, $find, $month, $blogType);
        $data['archives'] = $this->getBlogArchiveHtml();
        $data['bestSellers'] = $this->Public_model->getbestSellers();
        $rowscount = $this->Blog_model->postsCountByType($find, MY_LANGUAGE_ABBR, $blogType);
        $data['links_pagination'] = pagination($paginationBase, $rowscount, $this->num_rows, $page);
        $data['blogTypes'] = BlogType::labels();
        $data['selectedBlogType'] = $blogType;
        $this->render('blog', $head, $data);
    }

    public function viewPost($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = array();
        $head = array();
        $data['article'] = $this->Public_model->getOnePost($id);
        if ($data['article'] == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['archives'] = $this->getBlogArchiveHtml();
        $head['title'] = $data['article']['title'];
        $head['description'] = url_title(character_limiter(strip_tags($data['article']['description']), 130));
        $head['keywords'] = str_replace(" ", ",", $data['article']['title']);
        $this->render('view_blog_post', $head, $data);
    }

    public function viewPostBySlug($slug)
    {
        if (empty($slug)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $articleId = db_connect()->table('blog_posts')
            ->select('id')
            ->where('url', $slug)
            ->limit(1)
            ->get()
            ->getRow('id');

        if (empty($articleId)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->viewPost((int) $articleId);
    }

    private function getBlogArchiveHtml()
    {
        $selectedType = isset($_GET['type']) && is_numeric($_GET['type'])
            ? BlogType::normalize($_GET['type'])
            : null;
        $html = '
		<div class="alone title cloth-bg-color">
					<span>' . lang('archive') . '</span>
				</div>
				';
        if ($this->arhives !== false) {

            $html .= '<ul class="blog-artchive">';

            foreach ($this->arhives as $archive) {
                $archiveUrl = LANG_URL . '/blog?from=' . $archive['mintime'] . '&to=' . $archive['maxtime'];
                if ($selectedType !== null) {
                    $archiveUrl .= '&type=' . $selectedType;
                }
                $html .= '
					<li class="item">» <a href="' . $archiveUrl . '">'
                        . $archive['month'] . '</a></li>
				';
            }
            $html .= '</ul>';
        } else {
            $html = '<div class="alert alert-info">' . lang('no_archives') . '</div>';
        }
        return $html;
    }

}
