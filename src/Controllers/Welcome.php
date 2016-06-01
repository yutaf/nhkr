<?php

namespace App\Controllers;

use Http\Request;
use Http\Response;
use App\Template\FrontendRenderer;

class Welcome
{
    private $request;
    private $response;
    private $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }

    public function show()
    {
        $data = [
        ];
        $html = $this->renderer->render('Welcome', $data);
        $this->response->setContent($html);
    }
}