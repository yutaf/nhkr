<?php

namespace Src\Controllers;

use Http\Request;
use Http\Response;
use Src\Template\FrontendRenderer;
use Src\Template\SymfonyFormFactory;

abstract class Application
{
    protected $request;
    protected $response;
    protected $renderer;
    protected $formFactory;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer, SymfonyFormFactory $formFactory)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
        $this->formFactory = $formFactory;
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