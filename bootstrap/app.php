<?php

use Laminas\Diactoros\Response;
use DI\Container;
use Laminas\Diactoros\ServerRequestFactory;
use Middlewares\Utils\Dispatcher;

$container = new Container();
$request = ServerRequestFactory::fromGlobals();
$response = new Response();

$routerDispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', App\Actions\Home::class);
    $r->addRoute('GET', '/home', ['App\Actions\Home', 'index']);
    $r->addRoute('GET', '/home/{slug}', ['App\Actions\Home', 'run']);
});

$uri = $request->getUri()->getPath();
$routeInfo = $routerDispatcher->dispatch($request->getMethod(), $uri);
$routerHandler = '';
$routerVars = '';

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND: // 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED: // 405 Method Not Allowed
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $routerHandler = $handler;
        $routerVars = $vars;
        break;
}

// для отладки
var_dump($routerHandler);
//var_dump($routerVars);

$container->set(App\Middleware\DemoMiddleware::class, DI\factory( function () {
    return new App\Middleware\DemoMiddleware();
}));

$container->set(App\Middleware\RouteMiddleware::class, DI\factory( function () use ($routerHandler, $routerVars){
    return new App\Middleware\RouteMiddleware($routerHandler, $routerVars);
}));

$dispatcher = new Dispatcher(
    [
        $container->get(App\Middleware\DemoMiddleware::class),
        $container->get(App\Middleware\RouteMiddleware::class),
    ]
);

// выполнение
$response = $dispatcher->handle($request);

echo $response->getBody();

