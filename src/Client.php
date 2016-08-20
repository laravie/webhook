<?php

namespace Laravie\Webhook;

use Psr\Http\Message\StreamInterface;
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
     * @param  \Psr\Http\Message\UriInterface|string  $uri
     * @param  mixed  $body
     * @param  array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($method, $uri, $data = [], array $headers = [])
    {
        $headers = $this->prepareRequestHeaders($headers);
        list($headers, $body) = $this->prepareRequestPayloads($headers, $body);

        return $this->client->send(strtoupper($method), $uri, $headers, $body);
    }

    /**
     * Sends a GET request.
     *
     * @param  \Psr\Http\Message\UriInterface|string  $uri
     * @param  array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($uri, array $headers = [])
    {
        return $this->send('GET', $uri, $headers);
    }

    /**
     * Sends a POST request.
     *
     * @param  \Psr\Http\Message\UriInterface|string  $uri
     * @param  mixed  $data
     * @param  array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post($uri, $data = [], array $headers = [])
    {
        return $this->send('POST', $uri, $data, $headers);
    }

    /**
     * Sends a PUT request.
     *
     * @param  \Psr\Http\Message\UriInterface|string  $uri
     * @param  mixed  $data
     * @param  array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function put($uri, $data = [], array $headers = [])
    {
        return $this->send('PUT', $uri, $data, $headers);
    }

    /**
     * Sends a PATCH request.
     *
     * @param  \Psr\Http\Message\UriInterface|string  $uri
     * @param  mixed  $data
     * @param  array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function patch($uri, $data = [], array $headers = [])
    {
        return $this->send('PATCH', $uri, $data, $headers);
    }

    /**
     * Sends a DELETE request.
     *
     * @param  \Psr\Http\Message\UriInterface|string  $uri
     * @param  mixed  $data
     * @param  array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete($uri, $data = [], array $headers = [])
    {
        return $this->send('DELETE', $uri, $data, $headers);
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
     * Prepare request body.
     *
     * @param  array  $headers
     * @param  mixed  $body
     *
     * @return array
     */
    protected function prepareRequestPayloads(array $headers = [], $body = [])
    {
        if (isset($headers['Content-Type']) && $headers['Content-Type'] == 'application/json') {
            $body = json_encode($body);
        } elseif (! $body instanceof StreamInterface) {
            $body = http_build_query($body, null, '&');
        }

        return [$headers, $body];
    }
}
