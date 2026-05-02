<?php

namespace App\Modules\Admin\Controllers\AdvancedSettings;

use App\Core\AdminController;
use CodeIgniter\HTTP\ResponseInterface;

class Languages extends AdminController
{
    protected $languagesModel;

    public function __construct()
    {
        parent::__construct();
        $this->languagesModel = model(\App\Modules\Admin\Models\LanguagesModel::class);
    }

    public function index()
    {
        $this->login_check();
        $request  = service('request');
        $session  = session();

        // Handle delete
        if ($request->getGet('delete')) {
            $deleteId = $request->getGet('delete');
            if ($this->languagesModel->deleteLanguage($deleteId)) {
                $this->saveHistory("Delete language id - $deleteId");
                $session->setFlashdata('result_delete', 'Language is deleted!');
            } else {
                $session->setFlashdata('result_delete', 'Problem with language delete!');
            }
            return redirect()->to('/admin/languages');
        }

        // Handle edit
        if ($request->getGet('editLang')) {
            $editLang = $request->getGet('editLang');
            if ($this->languagesModel->countLangs($editLang) === 0) {
                return redirect()->to('/admin/languages');
            }
            $langFiles = $this->getLangFolderForEdit($editLang);
        }

        // Handle save language files
        if ($request->getPost('goDaddyGo')) {
            $this->saveLanguageFiles();
            return redirect()->to('/admin/languages');
        }

        $data = [];
        if (!is_writable(APPPATH . 'Language' . DIRECTORY_SEPARATOR)) {
            $data['writable'] = 'Languages folder is not writable!';
        }

        $head = [
            'title'       => 'Administration - Languages',
            'description' => '!',
            'keywords'    => ''
        ];

        if (isset($langFiles)) {
            $data['arrPhpFiles'] = $langFiles[0];
            $data['arrJsFiles']  = $langFiles[1];
        }

        $data['languages'] = $this->languagesModel->getLanguages();

        // Add language
        if ($request->getPost('name') && $request->getPost('abbr')) {
            $name = $request->getPost('name');
            $abbr = $request->getPost('abbr');

            if ($this->languagesModel->countLangs($name, $abbr) === 0) {
                $file = $this->request->getFile('userfile');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    if (!$file->isValid()) {
                        log_message('error', 'Language image upload error: ' . $file->getErrorString());
                    } else {
                        $newName = $file->getRandomName();
                        $file->move(FCPATH . 'attachments/lang_flags', $newName);
                        $_POST['flag'] = $newName;
                    }
                }

                $this->languagesModel->setLanguage($request->getPost());
                $this->createLangFolders($name);
                $session->setFlashdata('result_add', 'Language is added!');
                $this->saveHistory("Create language - $abbr");
            } else {
                $session->setFlashdata('result_add', 'This language exists!');
            }

            return redirect()->to('/admin/languages');
        }

        $data['max_input_vars'] = ini_get('max_input_vars');

        echo view('App\Modules\Admin\Views\advancedsettings\languages', array_merge($data, $head));


        $this->saveHistory('Go to languages');
    }

    private function saveLanguageFiles()
    {
        $request = service('request');
        $phpFiles  = $request->getPost('php_files');
        $phpValues = $request->getPost('php_values');
        $phpKeys   = $request->getPost('php_keys');

        $i = 0;
        $prevFile = 'none';
        $phpFileInclude = "<?php \n";

        foreach ($phpFiles as $phpFile) {
            if ($phpFile !== $prevFile && $i > 0) {
                savefile($prevFile, $phpFileInclude);
                $phpFileInclude = "<?php \n";
            }
            $php_value = str_replace("'", '&#39;', $phpValues[$i]);
            $php_value = str_replace('"', '&#34;', $php_value);
            $phpFileInclude .= '$lang[\'' . htmlentities(addslashes($phpKeys[$i])) . '\'] = \'' . $php_value . '\';' . "\n";
            $prevFile = $phpFile;
            $i++;
        }
        savefile($phpFile, $phpFileInclude);

        // JS files
        $jsFiles  = $request->getPost('js_files');
        $jsValues = $request->getPost('js_values');
        $jsKeys   = $request->getPost('js_keys');

        $i = 0;
        $prevFile = 'none';
        $jsFileInclude = "var lang = { \n";
        foreach ($jsFiles as $jsFile) {
            if ($jsFile !== $prevFile && $i > 0) {
                $jsFileInclude .= "};";
                savefile($prevFile, $jsFileInclude);
                $jsFileInclude = "var lang = { \n";
            }
            $jsFileInclude .= htmlentities(addslashes($jsKeys[$i])) . ':' . '"' . htmlentities(addslashes($jsValues[$i])) . '",' . "\n";
            $prevFile = $jsFile;
            $i++;
        }
        $jsFileInclude .= "};";
        savefile($jsFile, $jsFileInclude);
    }

    private function getLangFolderForEdit($langCode)
    {
        if (!ctype_alnum($langCode)) {
            return redirect()->to('/admin/languages');
        }

        $dir = APPPATH . 'Language' . DIRECTORY_SEPARATOR . $langCode . DIRECTORY_SEPARATOR;
        if (!is_dir(rtrim($dir, DIRECTORY_SEPARATOR))) {
            return redirect()->to('/admin/languages');
        }

        $arrPhpFiles = $arrJsFiles = [];
        $files = rreadDir($dir);

        foreach ($files as $ext => $filesLang) {
            foreach ($filesLang as $fileLang) {
                if ($ext === 'php') {
                    $file_content = file_get_contents($fileLang);
                    $tokens = token_get_all($file_content);
                    foreach ($tokens as $token) {
                        if (is_array($token) && $token[0] === T_VARIABLE) {
                            if ($token[1] !== '$lang') {
                                throw new \Exception("Invalid variable name in file $fileLang on line {$token[2]}");
                            }
                        }
                    }
                    require $fileLang;
                    if (isset($lang)) {
                        $arrPhpFiles[$fileLang] = $lang;
                        unset($lang);
                    }
                }
                if ($ext === 'js') {
                    $jsTrans = file_get_contents($fileLang);
                    preg_match_all('/(.+?)"(.+?)"/', $jsTrans, $PMA);
                    $arrJsFiles[$fileLang] = $PMA;
                    unset($PMA);
                }
            }
        }

        return [$arrPhpFiles, $arrJsFiles];
    }

    private function createLangFolders($newLang)
    {
        $newLang = strtolower(trim($newLang));
        if ($newLang !== '') {
            $from = APPPATH . 'Language' . DIRECTORY_SEPARATOR . MY_DEFAULT_LANGUAGE_NAME;
            $to   = APPPATH . 'Language' . DIRECTORY_SEPARATOR . $newLang;
            rcopy($from, $to);
        }
    }
}
