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
        $locale = $request->getLocale();

        $supportedLocales = ['en', 'vi'];
        if (! in_array($locale, $supportedLocales)) {
            $locale = Services::request()->config->defaultLocale ?? 'en';
        }

        Services::request()->setLocale($locale);
        service('language')->setLocale($locale);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // after loading controller
    }
}