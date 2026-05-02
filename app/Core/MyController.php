<?php

namespace App\Core;

use App\Controllers\BaseController;

class MyController extends BaseController
{

    public $nonDynPages = array();
    private $dynPages = array();
    protected $session;
    protected $shoppingcart;
    protected $sendmail;
    protected $loop;

    public function __construct()
    {
        defined('LANG_URL') || define('LANG_URL', rtrim(base_url(), '/'));
        $this->session = service('session');
        $this->shoppingcart = new \App\Libraries\ShoppingCart();
        $this->sendmail = new \App\Libraries\SendMail();
        $this->loop = new \App\Libraries\Loop();
        $this->getActivePages();
        //$this->checkForPostRequests();
        $this->setReferrer();
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
        $shared = $this->loadVars();

        // In CI4: we merge data instead of $this->load->vars()
        $head   = array_merge((array) $shared, (array) $head);
        $data   = array_merge((array) $shared, (array) $data);
        $footer = array_merge((array) $shared, (array) $footer);

        // Merge all data so layout, header, footer partials all have access
        $allData = array_merge($head, $data, $footer);

        // Render via layout (CI4 extend/section pattern)
        echo view($view, $allData);
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
        $publicModel = model(\App\Models\PublicModel::class);
        $vars['footerCategories'] = $publicModel->getFooterCategories();
        $vars['all_categories'] = $publicModel->getShopCategories();
        $vars['home_categories'] = $this->buildCategoryTree($vars['all_categories']);
        $vars['nav_categories'] = $vars['home_categories'];

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

        // Showrooms configured in admin panel
        $showroomModel = model(\App\Modules\Admin\Models\ShowroomModel::class);
        $vars['showrooms'] = $showroomModel->getActiveShowrooms();

        $vars['allLanguages'] = $this->getAllLangs();
        $vars['load'] = $this->loop;
        $vars['cookieLaw'] = $publicModel->getCookieLaw();
        $vars['multiVendor'] = isset($vars['multiVendor']) ? (int) $vars['multiVendor'] : 0;

        return $vars;
    }

    private function buildCategoryTree(array $elements, int $parentId = 0): array
    {
        $branch = [];

        foreach ($elements as $element) {
            if ((int) $element['sub_for'] === $parentId) {
                $children = $this->buildCategoryTree($elements, (int) $element['id']);
                if (!empty($children)) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
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
        $pagesModel = model(\App\Modules\Admin\Models\PagesModel::class);
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

    protected function subscribeUserRequest()
    {
        $subscribeEmail = $this->request->getPost('subscribeEmail');

        if (!$subscribeEmail) {
            return redirect()->back();
        }

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

        return redirect()->back();
    }

    /*
     * Set referrer to save it in orders
     */

    private function setReferrer()
    {
        if ($this->session->get('referrer') === null) {
            /*
            $ref = $this->request->getServer('HTTP_REFERER') ?? 'Direct';
            $this->session->set('referrer', $ref);
            */
        }
    }
}
