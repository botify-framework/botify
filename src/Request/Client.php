<?php

namespace Botify\Request;

use Amp\Http\Client\Body\FormBody;
use Amp\Http\Client\HttpClient;
use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Request;
use Amp\Promise;
use function Amp\call;
use function Botify\array_map_recursive;
use function Botify\config;
use function Botify\is_json;
use function Botify\tap;

final class Client
{
    private static HttpClient $httpClient;

    public function __construct()
    {
        self::$httpClient ??= HttpClientBuilder::buildDefault();
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param bool $stream
     * @return Promise
     */
    public function delete($uri, array $attributes = [], bool $stream = false): Promise
    {
        return $this->fetch(__FUNCTION__, $uri, $attributes, $stream);
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param bool $stream
     * @return Promise
     */
    public function get($uri, array $attributes = [], bool $stream = false): Promise
    {
        return $this->fetch(__FUNCTION__, $this->generateUri($uri, $attributes), [], $stream);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $attributes
     * @param bool $stream
     * @return Promise
     */
    protected function fetch($method, $uri, array $attributes, bool $stream = false): Promise
    {
        return call(function () use ($method, $uri, $attributes, $stream) {
            $promise = yield self::$httpClient->request(
                $this->makeRequest($method, $uri, $attributes)
            );

            $body = $promise->getBody();

            if ($stream === true)
                return $body;

            return is_json($response = yield $body->buffer()) ? json_decode(
                $response, true
            ) : $response;
        });
    }

    /**
     * @param $method
     * @param $uri
     * @param array $data
     * @return Request
     */
    private function makeRequest($method, $uri, array $data = []): Request
    {
        $method = strtoupper($method);

        return tap(new Request($this->generateUri($uri), $method), function (Request $request) use ($data) {
            if (!empty($data)) {
                $request->setBody(
                    $this->generateBody($data)
                );
            }
            $request->setInactivityTimeout(config('telegram.http.inactivity_timeout') * 1000);
            $request->setTransferTimeout(config('telegram.http.transfer_timeout') * 1000);
            $request->setBodySizeLimit(config('telegram.http.body_size_limit') * 1000);
        });
    }

    /**
     * @param $uri
     * @param array $queries
     * @return string
     */
    private function generateUri($uri, array $queries = []): string
    {
        $uri = ltrim($uri, '/');

        $url = filter_var($uri, FILTER_VALIDATE_URL) ?: sprintf(
            '%s/bot%s/%s', trim(config('telegram.base_uri')), config('telegram.token'), $uri
        );

        if (!empty($queries))
            $url .= '?' . http_build_query($queries);

        return $url;
    }

    /**
     * @param array $fields
     * @return FormBody
     */
    private function generateBody(array $fields): FormBody
    {
        $body = new FormBody();
        $fields = array_filter($fields);
        $files = [];

        $fields = array_map_recursive(function ($field) use (&$files) {
            if (is_string($field) && file_exists($field) && filesize($field) > 0) {
                $name = basename($field);
                $files[$name] = $field;
                return 'attach://' . $name;
            }

            return $field;
        }, $fields);

        foreach ($files as $fieldName => $content) {
            $body->addFile($fieldName, $content);
        }

        foreach ($fields as $fieldName => $content) {
            $body->addField(
                $fieldName,
                is_array($content) ? json_encode($content) : $content
            );
        }

        return $body;
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param bool $stream
     * @return Promise
     */
    public function post($uri, array $attributes = [], bool $stream = false): Promise
    {
        return $this->fetch(__FUNCTION__, $uri, $attributes, $stream);
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param bool $stream
     * @return Promise
     */
    public function put($uri, array $attributes = [], bool $stream = false): Promise
    {
        return $this->fetch(__FUNCTION__, $uri, $attributes, $stream);
    }
}