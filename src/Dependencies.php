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
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
    $twig = new Twig_Environment($loader);
    return $twig;
});

$injector->alias('Src\Template\FrontendRenderer', 'Src\Template\FrontendTwigRenderer');

$injector->alias('Src\Menu\MenuReader', 'Src\Menu\ArrayMenuReader');
$injector->share('Src\Menu\ArrayMenuReader');

$injector->define('Src\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/../pages',
]);

$injector->alias('Src\Page\PageReader', 'Src\Page\FilePageReader');
$injector->share('Src\Page\FilePageReader');

return $injector;