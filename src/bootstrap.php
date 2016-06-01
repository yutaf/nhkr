<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

//$environment = 'development';
//$environment = 'production';
$environment = getenv('ENVIRONMENT');

/**
 * Register the error handler
 */
$whoops = new \Whoops\Run;
if ($environment === 'production') {
    $whoops->pushHandler(function($e){
        echo 'Friendly error page and send an email to the developer';
    });
} else {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
}
$whoops->register();

//throw new \Exception;

$injector = include('Dependencies.php');

$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

foreach ($response->getHeaders() as $header) {
    header($header, false);
}

$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include('Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
switch($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];

        $class = $injector->make($className);
        $class->$method($vars);
        break;
}

echo $response->getContent();