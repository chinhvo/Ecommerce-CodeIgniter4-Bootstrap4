<?php

namespace App\Libraries;

class Language
{
    protected $CI;
    private $urlAbbrevation;

    public function __construct()
    {
        // Load models
        $this->homeAdminModel = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        $this->publicModel    = model(\App\Models\PublicModel::class);

        // Get first URI segment
        $this->urlAbbreviation = strtolower($this->request->uri->getSegment(1));

        // Set language
        $this->setLanguage();
    }

    private function setLanguage()
    {
        // Load default language settings from Config\App or your own Config\Custom
        $config = config('App'); // or your own Config class
        $defaultLanguageName = $language = $config->defaultLocale;
        $defaultLanguageAbbr = $myLanguage = strtolower($config->languageAbbr ?? 'en');
        $currency     = $config->currency ?? 'USD';
        $currencyKey  = $config->currencyKey ?? '$';
        $langLinkStart = '';

        // If selecting default language, redirect to base URL
        if ($this->urlAbbreviation === $defaultLanguageAbbr) {
            return redirect()->to(base_url());
        }

        // Get language from database
        $myLang = $this->publicModel->getOneLanguage($this->urlAbbreviation);
        if ($myLang !== null) {
            $myLanguage = $myLang['abbr'];
            $language   = $myLang['name'];
            $currency   = $myLang['currency'];
            $currencyKey = $myLang['currencyKey'];
            $langLinkStart = $myLanguage . '/';
        }

        // Load language file
        service('language')->setLocale($language);
        service('language')->load('site', $language);

        // Define constants
        defined('MY_LANGUAGE_FULL_NAME')      || define('MY_LANGUAGE_FULL_NAME', $language);
        defined('MY_LANGUAGE_ABBR')           || define('MY_LANGUAGE_ABBR', $myLanguage);
        defined('MY_DEFAULT_LANGUAGE_ABBR')   || define('MY_DEFAULT_LANGUAGE_ABBR', $defaultLanguageAbbr);
        defined('MY_DEFAULT_LANGUAGE_NAME')   || define('MY_DEFAULT_LANGUAGE_NAME', $defaultLanguageName);
        defined('CURRENCY')                   || define('CURRENCY', $currency);
        defined('CURRENCY_KEY')               || define('CURRENCY_KEY', $currencyKey);
        defined('LANG_URL')                   || define('LANG_URL', rtrim(base_url($langLinkStart), '/'));
    }

}
