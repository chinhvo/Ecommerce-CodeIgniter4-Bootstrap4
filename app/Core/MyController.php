<?php
namespace App\Core;
use App\Controllers\BaseController;

class MyController extends BaseController
{

    public $nonDynPages = array();
    private $dynPages = array();
    protected $template;

    public function __construct()
    {
        parent::__construct();
        $this->getActivePages();
        $this->checkForPostRequests();
        $this->setReferrer();
        //set selected template
        $this->loadTemplate();
    }

    /*
     * Render page from controller
     * it loads header and footer auto
     */

    public function render($view, $head, $data = null, $footer = null)
    {
        // Get cart data
        $head['cartItems'] = $this->shoppingcart->getCartItems();
        $head['sumOfItems'] = $this->shoppingcart->sumValues;

        // Load shared variables
        $vars = $this->loadVars();
        // In CI4: we merge data instead of $this->load->vars()
        $data = array_merge((array) $vars, (array) $data);

        // Get categories from model
        $publicModel = model(\App\Models\Public_model::class);

        $all_categories = $publicModel->getShopCategories();

        // Build category tree
        $buildTree = function (array $elements, $parentId = 0) use (&$buildTree) {
            $branch = [];
            foreach ($elements as $element) {
                if ($element['sub_for'] == $parentId) {
                    $children = $buildTree($elements, $element['id']);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
            return $branch;
        };

        $head['nav_categories'] = $buildTree($all_categories);

        // Render views
        echo view($this->template . '_parts/header', $head);
        echo view($this->template . $view, $data);
        echo view($this->template . '_parts/footer', $footer);
    }
    /*
     * Load variables from values-store
     * texts, social media links, logos, etc.
     */

    private function loadVars()
    {
        $vars = [];

        $vars['nonDynPages'] = $this->nonDynPages;
        $vars['dynPages'] = $this->dynPages;

        // Load from PublicModel
        $publicModel = model(\App\Models\Public_model::class);
        $vars['footerCategories'] = $publicModel->getFooterCategories();

        // Load from SettingsModel
        $settingsModel = model(\App\Modules\Admin\Models\SettingsModel::class);
        $values = $settingsModel->getValueStores();

        if (is_array($values) && count($values) > 0) {
            foreach ($values as $value) {
                if (!array_key_exists($value['thekey'], $vars)) {
                    $vars[$value['thekey']] = htmlentities($value['value']);
                }
            }
        }

        $vars['allLanguages'] = $this->getAllLangs();
        $vars['load'] = $this->loop;
        $vars['cookieLaw'] = $publicModel->getCookieLaw();

        return $vars;
    }

    /*
     * Get all added languages from administration
     */

    private function getAllLangs()
    {
        $arr = [];

        // Load LanguagesModel (CI4 namespace style)
        $languagesModel = model(\App\Modules\Admin\Models\LanguagesModel::class);
        $langs = $languagesModel->getLanguages();

        foreach ($langs as $lang) {
            $arr[$lang->abbr]['name'] = $lang->name;
            $arr[$lang->abbr]['flag'] = $lang->flag;
        }

        return $arr;
    }

    /*
     * Active pages for navigation
     * Managed from administration
     */

    private function getActivePages()
    {
        // Load models
        $pagesModel = model('App\Models\Admin\PagesModel');
        $publicModel = model('App\Models\PublicModel');

        // Get active pages
        $activeP = $pagesModel->getPages(true);

        // Get config item (assuming in app/Config/App.php or a custom config file)
        $dynPages = config('App')->no_dynamic_pages; // or config('CustomConfig')->no_dynamic_pages;

        $actDynPages = [];
        foreach ($activeP as $acp) {
            if (($key = array_search($acp, $dynPages)) !== false) {
                $actDynPages[] = $acp;
            }
        }

        $this->nonDynPages = $actDynPages;

        // Assuming getTextualPages is a helper function
        helper('textualpages'); // Load the helper
        $dynPages = getTextualPages($activeP);

        $this->dynPages = $publicModel->getDynPagesLangs($dynPages);
    }

    /*
     * Email subscribe form from footer
     */

    private function checkForPostRequests()
    {
        $subscribeEmail = $this->request->getPost('subscribeEmail');

        if ($subscribeEmail) {
            $arr = [
                'browser' => $this->request->getUserAgent()->getAgentString(),
                'ip'      => $this->request->getIPAddress(),
                'time'    => time(),
                'email'   => $subscribeEmail
            ];

            if (filter_var($arr['email'], FILTER_VALIDATE_EMAIL) && !$this->session->get('email_added')) {
                $this->session->set('email_added', 1);
                $publicModel = model('App\Models\PublicModel');
                $publicModel->setSubscribe($arr);
                $this->session->setFlashdata('emailAdded', lang('email_added'));
            }

            if (!headers_sent()) {
                return redirect()->to(base_url());
            } else {
                echo 'window.location = "' . base_url() . '"';
            }
        }
    }

    /*
     * Set referrer to save it in orders
     */

    private function setReferrer()
    {
        if ($this->session->get('referrer') === null) {
            $ref = $this->request->getServer('HTTP_REFERER') ?? 'Direct';
            $this->session->set('referrer', $ref);
        }
    }

    /*
     * Check for selected template 
     * and set it in config if exists
     */

    private function loadTemplate()
    {
        $homeAdminModel = model(\App\Modules\Admin\Models\HomeAdminModel::class);

        // Get template from DB
        $template = $homeAdminModel->getValueStore('template');

        // Get config value if DB is null
        if ($template === null) {
            $template = config('App')->template;
        } else {
            // Update config dynamically
            config('App')->template = $template;
        }

        // Check template directory exists
        if (!is_dir(TEMPLATES_DIR . $template)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('The selected template does not exist!');
        }

        $this->template = 'templates' . DIRECTORY_SEPARATOR . $template . DIRECTORY_SEPARATOR;
    }

}
