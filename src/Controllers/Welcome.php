<?php

namespace Src\Controllers;

class Welcome extends Application
{
    public function show()
    {
        $data = [
        ];
        $html = $this->renderer->render('Welcome', $data);
        $this->response->setContent($html);
    }
}