<?php

namespace Laravie\Webhook;

use Laravie\Codex\Discovery;
use Laravie\Codex\Support\HttpClient;
use Http\Client\Common\HttpMethodsClient;

class Client
{
    use HttpClient;

    /**
     * Content-Type for Webhook requests.
     *
     * @var string
     */
    protected $contentType = 'application/json';

    /**
     * Construct a new client.
     *
     * @param \Http\Client\Common\HttpMethodsClient  $http
     */
    public function __construct(HttpMethodsClient $http)
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
     * Set Content-Type value for webhook request.
     *
     * @param  string  $contentType
     *
     * @return $this
     */
    final public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get Content-Type value for webhook request.
     *
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
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
        $headers['Content-Type'] = $this->contentType;

        return $headers;
    }
}
