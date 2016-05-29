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

$injector->alias('Nhkr\Template\Renderer', 'Nhkr\Template\TwigRenderer');
//$injector->alias('Nhkr\Template\Renderer', 'Nhkr\Template\MustacheRenderer');
$injector->define('Mustache_Engine', [
    ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/../templates', [
            'extension' => '.html',
        ]),
    ],
]);

$injector->delegate('Twig_Environment', function() use ($injector) {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
    $twig = new Twig_Environment($loader);
    return $twig;
});

$injector->alias('Nhkr\Template\FrontendRenderer', 'Nhkr\Template\FrontendTwigRenderer');

$injector->alias('Nhkr\Menu\MenuReader', 'Nhkr\Menu\ArrayMenuReader');
$injector->share('Nhkr\Menu\ArrayMenuReader');

$injector->define('Nhkr\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/../pages',
]);

$injector->alias('Nhkr\Page\PageReader', 'Nhkr\Page\FilePageReader');
$injector->share('Nhkr\Page\FilePageReader');

return $injector;