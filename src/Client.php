<?php

namespace Laravie\Webhook;

use Laravie\Codex\Discovery;
use Laravie\Codex\Support\HttpClient;
use Http\Client\Common\HttpMethodsClient as HttpClient;

class Client
{
    use HttpClient;

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
     * Prepare request headers.
     *
     * @param  array  $headers
     *
     * @return array
     */
    protected function prepareRequestHeaders(array $headers = []): array
    {
        $headers['Content-Type'] = 'application/json';

        return $headers;
    }
}
