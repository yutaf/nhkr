<?php

namespace Src\Template;

interface Renderer
{
    public function render($template, $data = []);
}