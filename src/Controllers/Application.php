<?php

namespace Src\Controllers;

use Http\Request;
use Http\Response;
use Src\Template\FrontendRenderer;

abstract class Application
{
    protected $request;
    protected $response;
    protected $renderer;

    const SITE_NAME = 'NHK Reminder';

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }

    /**
     * Redirect to specified path
     *
     * @param $path
     */
    protected function redirectTo($path)
    {
        $protocol = 'http://';
        if(stripos($_SERVER['SERVER_PROTOCOL'],'https') === true) {
            $protocol = 'https://';
        }
        $redirect_url = "{$protocol}{$_SERVER['HTTP_HOST']}{$path}";
        header("Location: {$redirect_url}", true, 302);
    }
}