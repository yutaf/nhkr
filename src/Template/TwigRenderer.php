<?php

namespace Src\Template;

use Twig_Environment;

class TwigRenderer implements Renderer
{
    private $renderer;

    public function __construct(Twig_Environment $renderer, \Symfony\Component\Translation\Translator $translator)
    {
        $renderer->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension($translator));
        $this->renderer = $renderer;
    }

    public function render($template, $data = [])
    {
        return $this->renderer->render("$template.html", $data);
    }
}