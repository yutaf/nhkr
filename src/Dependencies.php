<?php

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

$injector->alias('Src\Template\Renderer', 'Src\Template\TwigRenderer');
//$injector->alias('Src\Template\Renderer', 'Src\Template\MustacheRenderer');
//$injector->define('Mustache_Engine', [
//    ':options' => [
//        'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/../templates', [
//            'extension' => '.html',
//        ]),
//    ],
//]);

$injector->delegate('Twig_Environment', function() use ($injector) {
    // the path to TwigBridge library so Twig can locate the
    // form_div_layout.html.twig file
    $appVariableReflection = new \ReflectionClass('\Symfony\Bridge\Twig\AppVariable');
    $vendorTwigBridgeDir = dirname($appVariableReflection->getFileName());

    $loader = new Twig_Loader_Filesystem([
        __DIR__.'/../templates',
        $vendorTwigBridgeDir.'/Resources/views/Form',
    ]);
    $twig = new Twig_Environment($loader);
    return $twig;
});
$injector->delegate('Symfony\Bridge\Twig\Form\TwigRendererEngine', function() use ($injector) {
    $defaultFormTheme = 'form_div_layout.html.twig';
    $formEngine = new Symfony\Bridge\Twig\Form\TwigRendererEngine([$defaultFormTheme]);
    return $formEngine;
});

$injector->alias('Src\Template\FrontendRenderer', 'Src\Template\FrontendTwigRenderer');

$injector->share('Symfony\Component\Translation\Translator');
$injector->delegate('Symfony\Component\Translation\Translator', function() use ($injector) {
    $locale = 'en';
    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && strlen($_SERVER['HTTP_ACCEPT_LANGUAGE'])>0) {
        $locale = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }
    $translator = new Symfony\Component\Translation\Translator($locale, new \Symfony\Component\Translation\MessageSelector());
    $translator->setFallbackLocales(['en']);
    $translator->addLoader('yaml', new Symfony\Component\Translation\Loader\YamlFileLoader());
    $translator->addResource('yaml',  __DIR__.'/../locales/en.yml', 'en');
    $translator->addResource('yaml',  __DIR__.'/../locales/ja.yml', 'ja');

    return $translator;
});

$injector->share('Symfony\Component\Security\Csrf\CsrfTokenManager');

$injector->alias('Src\Menu\MenuReader', 'Src\Menu\ArrayMenuReader');
$injector->share('Src\Menu\ArrayMenuReader');

$injector->define('Src\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/../pages',
]);

$injector->alias('Src\Page\PageReader', 'Src\Page\FilePageReader');
$injector->share('Src\Page\FilePageReader');

return $injector;