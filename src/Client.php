<?php

namespace Laravie\Webhook;

use Laravie\Codex\Response;
use Laravie\Codex\Discovery;
use Laravie\Codex\Support\Resources;
use Laravie\Codex\Support\HttpClient;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use Http\Client\Common\HttpMethodsClient as HttpClient;

class Client
{
    use HttpClient, Resources;

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
}
