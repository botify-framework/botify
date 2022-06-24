<?php

namespace Jove;

use Amp\Http\Client\Body\FormBody;
use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Request;
use Amp\Loop;
use Amp\Promise;
use Jove\Methods\Methods;
use function Amp\call;

class TelegramAPI
{
    use Methods;

    private static $client;
    private EventHandler $eventHandler;

    /**
     * @param $eventHandler
     * @return EventHandler
     * @throws \Exception
     */
    public function setEventHandler($eventHandler): EventHandler
    {
        if ($eventHandler instanceof EventHandler) {
            return $this->eventHandler = $eventHandler;
        }

        throw new \Exception(sprintf(
            'The eventHandler must be instance of %s', EventHandler::class,
        ));

    }

    public function loop()
    {
        Loop::run(function () {
            $offset = -1;

            while (true) {
                $updates = yield $this->getUpdates($offset, timeout: 10);

                if (is_array($updates)) {
                    foreach ($updates as $update) {
                        $offset = $update->update_id + 1;
                        call(fn() => $this->eventHandler->boot($update));
                    }
                }
            }
        });
    }

    /**
     * @param $uri
     * @param array $attributes
     * @return Promise
     */
    protected function post($uri, array $attributes = []): Promise
    {
        return call(function () use ($uri, $attributes) {
            $client = static::$client ??= HttpClientBuilder::buildDefault();
            $promise = yield $client->request(
                $this->generateRequest($uri, $attributes)
            );
            return json_decode(
                yield $promise->getBody()->buffer(), true
            );
        });
    }

    /**
     * @param $uri
     * @param array $data
     * @return Request
     */
    private function generateRequest($uri, array $data = []): Request
    {
        return \tap(new Request($this->generateUri($uri), 'POST'), fn($request) => $request->setBody(
            $this->generateBody($data)
        ));
    }

    /**
     * @param array $fields
     * @return FormBody
     */
    private function generateBody(array $fields): FormBody
    {
        $body = new FormBody();
        $fields = \array_filter($fields);

        foreach ($fields as $fieldName => $content)
            if (\is_string($content) && \file_exists($content) && \filesize($content) > 0)
                $body->addFile($fieldName, $content);
            else
                $body->addField($fieldName, $content);

        return $body;
    }

    /**
     * @param $uri
     * @param array $queries
     * @return string
     */
    private function generateUri($uri, array $queries = []): string
    {
        $url = \sprintf('https://api.telegram.org/bot%s/', \getenv('BOT_TOKEN'));

        if (! empty($uri))
            $url .= \ltrim($uri, '/');

        if (! empty($queries))
            $url .= '?' . \http_build_query($queries);

        return $url;
    }
}