<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $locale = service('request')->getLocale();

        $message  = lang('site.products');

        return view('welcome_message');
    }
}
