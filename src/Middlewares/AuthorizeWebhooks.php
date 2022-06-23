<?php

namespace Jove\Middlewares;

use Amp\Http\Server\Middleware;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler;
use Amp\Promise;
use function Amp\call;

class AuthorizeWebhooks implements Middleware
{

    /**
     * Authorize telegram webhook requests
     *
     * @param Request $request
     * @param RequestHandler $next
     * @return Promise
     */
    public function handleRequest(Request $request, RequestHandler $next): Promise
    {
        /**
         * In the latest version of telegram the "secret_token" field was added when setting the webhook.
         * This middleware can help you to authorize your with secret_token.
         */
        return call(function () use ($request, $next) {
            $env = strtolower(getenv('APP_ENV'));

            if ($env === 'development') {
                return $next->handleRequest($request, $next);
            } elseif (getenv('APP_ENV') === 'production'
                && $request->getHeader('X-Telegram-Bot-Api-Secret-Token') === getenv('SECURE_TOKEN'))
                return $next->handleRequest($request, $next);

            return false;
        });
    }
}