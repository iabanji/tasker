<?php

namespace app\core;

/**
 * Class BaseController
 * @package app\core
 */
Class BaseController
{
    /**
     * Default value
     * @var string
     */
    public $layout = 'main';
    /**
     * @var null
     */
    public $childCName = null;

    /**
     * Default value
     * @var string
     */
    public $view = 'index';

    /**
     * Render view into layout param BaseController $layout
     * @param $view
     * @param array $data
     */
    public function render($view, $data = [])
    {
        $this->view = $view;
        extract($data);

        $layoutFile = $this->app->getParam('layoutPath') . '/' . $this->layout . '.php';

        if(is_file($layoutFile))
        {
            include_once $layoutFile;
        }

    }

    /**
     * Permanently redirect
     * @param $url
     */
    public function redirect($url)
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $url");
    }
}
