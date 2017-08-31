<?php

namespace Laravie\Webhook;

use Laravie\Codex\Response;
use Laravie\Codex\Discovery;
use Laravie\Codex\Support\Resources;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use Http\Client\Common\HttpMethodsClient as HttpClient;

class Client
{
    use Resources;

    /**
     * Http Client instance.
     *
     * @var \Http\Client\Common\HttpMethodsClient
     */
    protected $http;

    /**
     * Construct a new client.
     *
     * @param \Http\Client\Common\HttpMethodsClient  $http
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Make a client.
     *
     * @return $this
     */
    public static function make()
    {
        return new static(Discovery::client());
    }

    /**
     * Ping an endpoint.
     *
     * @param  string  $method
     * @param  \Laravie\Codex\Endpoint|string  $path
     * @param  array  $headers
     * @param  Psr\Http\Message\StreamInterface|array  $body
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function send($method, $path, array $headers = [], $body = [])
    {
        list($headers, $body) = $this->prepareRequestPayloads($headers, $body);

        $method = strtoupper($method);

        $endpoint = $this->convertUriToEndpoint($path);

        if ($method === 'GET' && ! $body instanceof StreamInterface) {
            $endpoint->addQuery($body);
            $body = [];
        }

        return $this->responseWith(
            $this->http->send($method, $endpoint->get(), $headers, $body)
        );
    }

    /**
     * Prepare request headers.
     *
     * @param  array  $headers
     *
     * @return array
     */
    protected function prepareRequestHeaders(array $headers = [])
    {
        $headers['Content-Type'] = 'application/json';

        return $headers;
    }

    /**
     * Resolve the responder class.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseWith(ResponseInterface $response)
    {
        return new Response($response);
    }

    /**
     * Convert URI to Endpoint object.
     *
     * @param  \Laravie\Codex\Endpoint|string  $uri
     * @return \Laravie\Codex\Endpoint
     */
    protected function convertUriToEndpoint($uri)
    {
        if ($uri instanceof Endpoint) {
            return $uri;
        }

        return new Endpoint($uri);
    }

    /**
     * Prepare request body.
     *
     * @param  array  $headers
     * @param  \Psr\Http\Message\StreamInterface|array  $body
     *
     * @return array
     */
    protected function prepareRequestPayloads(array $headers = [], $body = [])
    {
        $headers = $this->prepareRequestHeaders($headers);

        if ($body instanceof StreamInterface) {
            return [$headers, $body];
        }

        if (isset($headers['Content-Type']) && $headers['Content-Type'] == 'application/json') {
            $body = json_encode($body);
        } elseif (is_array($body)) {
            $body = http_build_query($body, null, '&');
        }

        return [$headers, $body];
    }
}
