<?php

namespace App\Controllers;

use App\Core\MyController;

/* Set internal character encoding to UTF-8 */
mb_internal_encoding("UTF-8");

class Loader extends MyController
{
    protected $Home_admin_model;

    public function __construct()
    {
        parent::__construct();
        $this->Home_admin_model = model(\App\Modules\Admin\Models\HomeAdminModel::class);
        helper('file');
    }

    /*
     * Load language javascript file
     */

    public function jsFile($file = null)
    {
        $contents = file_get_contents(APPPATH . 'Language' . DIRECTORY_SEPARATOR . strtolower(MY_LANGUAGE_FULL_NAME) . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . $file);
        if (!$contents) {
            return $this->response->setStatusCode(404);
        }
        return $this->response
            ->setContentType('application/javascript; charset=UTF-8')
            ->setBody($contents);
    }

    /*
     * Load css generated from administration -> styles
     */

    public function cssStyle()
    {
        $style = $this->Home_admin_model->getValueStore('newStyle');
        if ($style == null) {
            $template = $this->template;
            $style = file_get_contents(VIEWS_DIR . $template . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'default-gradient.css');
            if (!$style) {
                return $this->response->setStatusCode(404);
            }
        }
        return $this->response
            ->setContentType('text/css; charset=UTF-8')
            ->setBody($style);
    }

    /*
     * Load css file for template
     * Can call css file in folder /assets/css/ with templatecss/filename.css
     */

    public function templateCss($file)
    {
        $template = $this->template;
        $style = file_get_contents(VIEWS_DIR . $template . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . $file);
        if (!$style) {
            return $this->response->setStatusCode(404);
        }
        return $this->response
            ->setContentType('text/css; charset=UTF-8')
            ->setBody($style);
    }

    /*
     * Load js file for template
     * Can call css file in folder /assets/js/ with templatecss/filename.js
     */

    public function templateJs($file)
    {
        $template = $this->template;
        $js = file_get_contents(VIEWS_DIR . $template . 'assets' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . $file);
        if (!$js) {
            return $this->response->setStatusCode(404);
        }
        return $this->response
            ->setContentType('application/javascript; charset=UTF-8')
            ->setBody($js);
    }

    /*
     * Load images comming with template in folder /assets/imgs/
     * Can call from view with template/imgs/filename.jpg
     */

    public function templateCssImage($file, $template = null)
    {
        if ($template == null) {
            $template = $this->template;
        } else {
            $template = DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . DIRECTORY_SEPARATOR;
        }
        $path = VIEWS_DIR . $template . 'assets' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $file;
        
        $img = @file_get_contents($path);
        if (!$img) {
            return $this->response->setStatusCode(404);
        }

        $image_mime = 'application/octet-stream';
        if (function_exists('mime_content_type')) {
            $image_mime = mime_content_type($path);
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $image_mime = finfo_file($finfo, $path);
            finfo_close($finfo);
        }
        return $this->response
            ->setContentType($image_mime)
            ->setBody($img);
    }

}
