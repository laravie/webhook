<?php

namespace Laravie\Webhook;

use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Client\Common\HttpMethodsClient as HttpClient;

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
     * Make a client.
     *
     * @return $this
     */
    public static function make()
    {
        $client = new HttpClient(
            HttpClientDiscovery::find(),
            MessageFactoryDiscovery::find()
        );

        return new static($client);
    }

    /**
     * Ping an endpoint.
     *
     * @param  string  $method
     * @param  string  $uri
     * @param  mixed  $data
     * @param  array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($method, $uri, $data = [], array $headers = [])
    {
        $body = json_encode($data);

        $headers['Content-Type'] = 'application/json';

        return $this->client->send(strtoupper($method)), $uri, $headers, $body);
    }
}
