<?php

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

class Home
{
    public function __invoke(Request $request, Handler $handler): Response
    {
        $response = $handler->handle($request);
        $response->getBody()->write($request->getAttribute('m') . '<br />');
        return $response;
    }

    public function run(Request $request, Handler $handler): Response
    {
        $response = $handler->handle($request); // 1
        $response->getBody()->write('Home run '); // 2
        return $response;
    }

    public function index(Request $request, Handler $handler): Response
    {
        $response = $handler->handle($request); // 1
        $response->getBody()->write('Home index '); // 2
        return $response;
    }
}