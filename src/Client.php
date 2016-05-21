<?php

namespace Laravie\Webhook;

use Http\Client\HttpClient;

class Client
{
    /**
     * Construct a new client.
     *
     * @param \Http\Client\HttpClient  $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Ping an endpoint.
     *
     * @param  string  $method
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($method, $uri, array $data = [], array $headers = [])
    {
        $body = json_encode($data);

        $headers['Content-Type'] = 'application/json';

        return $this->client->send(strtoupper($method)), $uri, $headers, $body);
    }
}
