<?php

namespace Jove\Middlewares;

use Amp\Http\Server\Middleware;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler;
use Amp\Http\Server\Response;
use Amp\Promise;
use function Amp\call;

class AuthorizeWebhooks implements Middleware
{

    /**
     * Authorize telegram webhook requests
     *
     * @param Request $request
     * @param RequestHandler $requestHandler
     * @return Promise
     */
    public function handleRequest(
        Request        $request,
        RequestHandler $requestHandler
    ): Promise
    {
        /**
         * In the latest version of telegram the "secret_token" field was added when setting the webhook.
         * This middleware can help you to authorize your with secret_token.
         */
        return call(function () use ($request, $requestHandler) {
            $next = fn() => $requestHandler->handleRequest($request, $requestHandler);

            if ('production' === \strtolower(\getenv('APP_ENV'))) {
                if ($request->getHeader('X-Telegram-Bot-Api-Secret-Token') === \getenv('SECURE_TOKEN')) {
                    return $next();
                }

                return new Response(403, [
                    'Content-Type' => 'application/json;charset=utf-8'
                ], \json_encode([
                    'success' => false,
                    'message' => 'You are not allowed.',
                ]));
            }

            return $next();
        });
    }
}