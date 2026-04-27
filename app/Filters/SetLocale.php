<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class SetLocale implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $appConfig = config('App');

        // Read language folder from cookie (e.g. 'vietnamese', 'english')
        $cookieLang = service('request')->getCookie('site_lang');

        if ($cookieLang !== null) {
            // Validate: folder must actually exist in Language/
            $langPath = APPPATH . 'Language/' . basename($cookieLang) . '/';
            if (is_dir($langPath)) {
                $session->set('lang_folder', strtolower(basename($cookieLang)));
            }
        }

        // Fallback: use session value, then constant default
        if (! $session->has('lang_folder')) {
            $session->set('lang_folder', strtolower(MY_DEFAULT_LANGUAGE_NAME));
        }

        // Resolve locale abbreviation
        $locale = service('request')->getLocale();
        $supportedLocales = ['vi'];
        if (! in_array($locale, $supportedLocales)) {
            $locale = $appConfig->defaultLocale ?? 'vi';
        }

        Services::request()->setLocale($locale);
        service('language')->setLocale($locale);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // after loading controller
    }
}