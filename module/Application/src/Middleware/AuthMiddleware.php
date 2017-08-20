<?php

namespace Application\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class AuthMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $headers = $request->getHeaders();

        if (isset($headers['X-Auth-Token'])) {
            return $delegate->process($request);
        }

        return new Response('php://memory', 401);
    }
}