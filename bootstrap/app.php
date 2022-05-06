<?php

use App\Infrastructure\App;
use App\Infrastructure\Test;
use Laminas\Diactoros\Response;
use Psr\Container\ContainerInterface;
use DI\Container;
use Laminas\Diactoros\ServerRequestFactory;
use App\Infrastructure\ResponseSender;

$request = ServerRequestFactory::fromGlobals();
$response = new Response();

$container = new Container();
$container->set(Test::class, DI\create(Test::class));
$container->set(App::class, DI\factory( function (ContainerInterface $container) {
    return new App($container->get(Test::class));
}));

$app = $container->get(App::class);

//$app->test();

$response = $response->withHeader('X-Framework-version', '0.1');
$response->getBody()->write('Ahahahahha');

$emitter = new ResponseSender();
$emitter->send($response);

