<?php

namespace Jove\Middlewares;

use Amp\Http\Server\Middleware;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Status;
use Amp\Promise;

use function Amp\call;

class TrustIsTelegram implements Middleware
{

    public function handleRequest(Request $request, RequestHandler $next): Promise
    {
        return call(function () use ($request, $next) {
            return $next->handleRequest($request, $next);
        });
    }
}