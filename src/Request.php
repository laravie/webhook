<?php

namespace Laravie\Webhook;

use Laravie\Codex\Common\Response;
use Psr\Http\Message\ResponseInterface;
use Laravie\Codex\Contracts\Endpoint as EndpointContract;
use Laravie\Codex\Contracts\Response as ResponseContract;

class Request extends \Laravie\Codex\Common\Request
{
    /**
     * Send Webhook request.
     *
     * @param  \Laravie\Codex\Contracts\Endpoint|string  $url
     * @param  \Psr\Http\Message\StreamInterface|\Laravie\Codex\Payload|array|null  $body
     */
    public function send($url, array $headers = [], $body = []): ResponseContract
    {
        $endpoint = $url instanceof EndpointContract ? $url : static::to($url);

        return $this->responseWith(
            $this->client->send('POST', $endpoint, $headers, $body)
        );
    }

    /**
     * Resolve the responder class.
     */
    protected function responseWith(ResponseInterface $message): ResponseContract
    {
        return new Response($message);
    }

    /**
     * Get API Header.
     */
    protected function getWebhookHeaders(): array
    {
        return [];
    }

    /**
     * Get API Body.
     */
    protected function getWebhookBody(): array
    {
        return [];
    }

    /**
     * Merge API Headers.
     */
    final protected function mergeWebhookHeaders(array $headers = []): array
    {
        return \array_merge($this->getWebhookHeaders(), $headers);
    }

    /**
     * Merge API Body.
     *
     * @param  array  $headers
     */
    final protected function mergeWebhookBody(array $body = []): array
    {
        return \array_merge($this->getWebhookBody(), $body);
    }
}
