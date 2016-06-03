<?php

namespace App\Controllers;

use Http\Request;
use Http\Response;
use App\Template\FrontendRenderer;

class Home
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
        //TODO
        $protocol = 'http://';
        if(stripos($_SERVER['SERVER_PROTOCOL'],'https') === true) {
            $protocol = 'https://';
        }
        $redirect_url = "{$protocol}{$_SERVER['HTTP_HOST']}/welcome";
        header("Location: {$redirect_url}", true);
        exit;
//        $data = [
//            'name' => $this->request->getParameter('name', 'stranger'),
//        ];
//        $html = $this->renderer->render('Homepage', $data);
//        $this->response->setContent($html);
    }
}