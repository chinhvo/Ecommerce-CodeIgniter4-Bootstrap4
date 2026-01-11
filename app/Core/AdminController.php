<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
namespace App\Core;

use App\Controllers\BaseController;

class AdminController extends BaseController
{

    protected $username;
    protected $activePages;
    protected $allowed_img_types;
    protected $history;

   
    public function __construct()
    {        
        // Form validation service
        $this->validation = \Config\Services::validation();
        
        // Config values
        $config                 = config('App'); // Replace 'App' with your custom config if needed
        $this->history           = $config->admin_history ?? null;
        $this->allowed_img_types = $config->allowed_img_types ?? [];
        
        // Model loading
        $this->HomeAdminModel = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        
        // Get active pages
        $this->activePages = $this->getActivePages();
        
        // Prepare variables for views
        $view = \Config\Services::renderer(); // Get the View instance
        
        $view->setVar('activePages',  $this->activePages);
        $view->setVar('numNotPreviewOrders', $this->HomeAdminModel->newOrdersCheck());
        $view->setVar('textualPages', getTextualPages($this->activePages));
        $view->setVar('nonDynPages', $config->no_dynamic_pages ?? []);
        $view->setVar('warnings', $this->warningChecker());
        $view->setVar('showBrands', $this->HomeAdminModel->getValueStore('showBrands'));
        $view->setVar('virtualProducts', $this->HomeAdminModel->getValueStore('virtualProducts'));
    }

    protected function login_check()
    {
        $session = session(); // CI4 session instance
        
        if (!$session->get('logged_in')) {
            return redirect()->to('/admin');
        }
        
        $this->username = $session->get('logged_in');
    }

    protected function saveHistory($activity)
    {
        if ($this->history === true) {
            // Load model (CI4 style)
            $historyModel = model(\App\Modules\Admin\Models\HistoryModel::class);
            
            $usr = $this->username;
            $historyModel->setHistory($activity, $usr);
        }
    }

    public function getActivePages()
    {
        $pagesModel = model(\App\Modules\Admin\Models\PagesModel::class);
        return $pagesModel->getPages(true, false);
    }

    private function warningChecker()
    {
        $errors = [];
        
        // Check writable/language folder
        if (!is_writable(APPPATH . 'Language')) {
            $errors[] = 'Language folder is not writable!';
        }
        
        // Check writable/logs folder
        if (!is_writable(WRITEPATH . 'logs')) {
            $errors[] = 'Logs folder is not writable!';
        }
        
        // Check attachments folder
        $attachmentsPath = FCPATH . 'attachments';
        
        if (!is_writable($attachmentsPath)) {
            $errors[] = 'Attachments folder is not writable!';
        } else {
            // Subfolders to check/create
            $subfolders = [
                'blog_images',
                'lang_flags',
                'shop_images',
                'site_logo'
            ];
            
            foreach ($subfolders as $folder) {
                $path = $attachmentsPath . DIRECTORY_SEPARATOR . $folder;
                
                if (!file_exists($path)) {
                    $old = umask(0);
                    mkdir($path, 0777, true);
                    umask($old);
                }
            }
        }
        
        return $errors;
    }

}
