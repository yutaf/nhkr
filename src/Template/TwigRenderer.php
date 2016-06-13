<?php

namespace Src\Template;

use Symfony\Component\Translation\Translator;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Twig_Environment;

class TwigRenderer implements Renderer
{
    private $renderer;

    public function __construct(Twig_Environment $renderer, Translator $translator, TwigRendererEngine $formEngine, CsrfTokenManager $csrfTokenManager)
    {
        $translationExtension = new \Symfony\Bridge\Twig\Extension\TranslationExtension($translator);
        $renderer->addExtension($translationExtension);
        $formEngine->setEnvironment($renderer);

        $formTwigRenderer = new \Symfony\Bridge\Twig\Form\TwigRenderer($formEngine, $csrfTokenManager);
        $formExtension = new \Symfony\Bridge\Twig\Extension\FormExtension($formTwigRenderer);
        $renderer->addExtension($formExtension);

        $this->renderer = $renderer;
    }

    public function render($template, $data = [])
    {
        return $this->renderer->render("$template.html", $data);
    }
}