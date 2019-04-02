<?php

namespace Laravie\Webhook;

use Laravie\Codex\Common\Response;
use Psr\Http\Message\ResponseInterface;
use Laravie\Codex\Contracts\Endpoint as EndpointContract;
use Laravie\Codex\Contracts\Response as ResponseContract;

abstract class Request extends \Laravie\Codex\Common\Request
{
    /**
     * Send Webhook request.
     *
     * @param  \Laravie\Codex\Contracts\Endpoint|string  $url
     * @param  array  $headers
     * @param  \Psr\Http\Message\StreamInterface|\Laravie\Codex\Payload|array|null  $body
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function send($url, array $headers = [], $body = []): ResponseContract
    {
        $endpoint = $url instanceof EndpointContract ? $url : static::to($url);

        return $this->responseWith(
            $this->client->send('POST', $endpoint, $headers, $body)
        );
    }

    /**
     * Resolve the responder class.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $message
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseWith(ResponseInterface $message): ResponseContract
    {
        return new Response($message);
    }

    /**
     * Get API Header.
     *
     * @return array
     */
    protected function getWebhookHeaders(): array
    {
        return [];
    }

    /**
     * Get API Body.
     *
     * @return array
     */
    protected function getWebhookBody(): array
    {
        return [];
    }

    /**
     * Merge API Headers.
     *
     * @param  array  $headers
     *
     * @return array
     */
    final protected function mergeWebhookHeaders(array $headers = []): array
    {
        return \array_merge($this->getWebhookHeaders(), $headers);
    }

    /**
     * Merge API Body.
     *
     * @param  array  $headers
     *
     * @return array
     */
    final protected function mergeWebhookBody(array $body = []): array
    {
        return \array_merge($this->getWebhookBody(), $body);
    }
}
