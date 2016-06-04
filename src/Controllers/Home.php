<?php

namespace Src\Controllers;

class Home extends Application
{
    public function show()
    {
        //TODO login check
        $this->redirectTo('/welcome');
        exit;
//        $data = [
//            'name' => $this->request->getParameter('name', 'stranger'),
//        ];
//        $html = $this->renderer->render('Home', $data);
//        $this->response->setContent($html);
    }
}