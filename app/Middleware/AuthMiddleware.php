<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    protected string $path;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $uri = $request->getUri()->getPath();
        $response->getBody()->write('AuthMiddleware<br />'); // 2
        $request = $request->withAttribute('m', 'Request post');
        return $handler->handle($request);
    }
}