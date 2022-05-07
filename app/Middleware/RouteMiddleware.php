<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouteMiddleware implements MiddlewareInterface
{
    private mixed $routerHandler;
    private mixed $routerVars;

    public function __construct($routerHandler, $routerVars)
    {
        $this->routerHandler = $routerHandler;
        $this->routerVars = $routerVars;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (is_string($this->routerHandler)) {
            $class = $this->routerHandler;
            $method = false;
        } else {
            $class = $this->routerHandler[0];
            $method = $this->routerHandler[1];
        }

        if (!class_exists($class)) return $handler->handle($request); // передаём управление следующему middleware

        $obj = new $class($this->routerVars);
        if ($method) {
            return $obj->$method($request, $handler);
        } else {

            if (method_exists($obj, '__invoke')) {
                return $obj($request, $handler);
            } else {
                return new $class($request, $handler);
            }
        }
    }
}