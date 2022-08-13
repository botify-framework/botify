<?php

namespace Botify\Request;

use Amp\ByteStream\Payload;
use Amp\Http\Client\Body\FormBody;
use Amp\Http\Client\HttpClient;
use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Request;
use Amp\Http\Client\Response;
use Amp\Promise;
use function Amp\call;
use function Botify\config;
use function Botify\is_json;
use function Botify\tap;

final class Client
{
    private HttpClient $httpClient;

    private array $uploadable_types = ['animation', 'audio', 'document', 'photo', 'sticker', 'video', 'video_note', 'voice',];

    public function __construct()
    {
        $this->httpClient ??= HttpClientBuilder::buildDefault();
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param array $headers
     * @return Promise
     */
    public function delete($uri, array $attributes = [], array $headers = []): Promise
    {
        return $this->fetch(__FUNCTION__, $uri, $attributes, $headers);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $attributes
     * @param array $headers
     * @return Promise
     */
    protected function fetch($method, $uri, array $attributes = [], array $headers = []): Promise
    {
        return call(function () use ($method, $uri, $attributes, $headers) {
            $response = yield $this->httpClient->request(
                $this->makeRequest($method, $uri, $attributes, $headers)
            );

            return new class($response) {
                public function __construct(public Response $response)
                {
                }

                public function json(): Promise
                {
                    return call(function () {
                        $body = $this->response->getBody();

                        return is_json($response = yield $body->buffer()) ? json_decode(
                            $response, true
                        ) : $response;
                    });
                }

                public function stream(): Payload
                {
                    return $this->response->getBody();
                }

                public function __call(string $name, array $arguments = [])
                {
                    return call_user_func_array([$this->response, $name], $arguments);
                }
            };
        });
    }

    /**
     * @param $method
     * @param $uri
     * @param array $data
     * @param array $headers
     * @return Request
     */
    private function makeRequest($method, $uri, array $data = [], array $headers = []): Request
    {
        $method = strtoupper($method);

        return tap(new Request($this->generateUri($uri), $method), function (Request $request) use ($data, $headers) {
            if (!empty($data)) {
                $request->setBody(
                    $this->generateBody($data)
                );
            }
            $request->setHeaders((array)$headers);
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
        $files = [];

        array_walk_recursive($fields, function (&$value, $attribute) use (&$files) {
            if (is_string($value) && is_file($value) && filesize($value) > 0 && in_array(strtolower($attribute), $this->uploadable_types)) {
                $name = basename($value);
                $files[$name] = $value;
                $value = 'attach://' . $name;
            }
        });

        foreach ($files as $fieldName => $content) {
            $body->addFile($fieldName, $content);
        }

        foreach ($fields as $fieldName => $content) {
            $body->addField(
                $fieldName,
                is_array($content) ? json_encode($content) : ($content ?: '')
            );
        }

        return $body;
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param array $headers
     * @return Promise
     */
    public function get($uri, array $attributes = [], array $headers = []): Promise
    {
        return $this->fetch(__FUNCTION__, $this->generateUri($uri, $attributes), [], $headers);
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param array $headers
     * @return Promise
     */
    public function post($uri, array $attributes = [], array $headers = []): Promise
    {
        return $this->fetch(__FUNCTION__, $uri, $attributes, $headers);
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param array $headers
     * @return Promise
     */
    public function put($uri, array $attributes = [], array $headers = []): Promise
    {
        return $this->fetch(__FUNCTION__, $uri, $attributes, $headers);
    }
}