<?php

namespace Laravie\Webhook;

use Laravie\Codex\Support\Responsable;
use Laravie\Codex\Request as BaseRequest;
use Laravie\Codex\Contracts\Request as RequestContract;
use Laravie\Codex\Contracts\Response as ResponseContract;

abstract class Request implements RequestContract
{
    use Responsable;

    /**
     * Send Webhook request.
     *
     * @param  \Laravie\Codex\Contracts\Endpoint|string  $path
     * @param  array  $headers
     * @param  \Psr\Http\Message\StreamInterface|\Laravie\Codex\Payload|array|null  $body
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function sendWebhook($path, array $headers = [], $body = []): ResponseContract
    {
        return $this->send('POST', $path, $headers, $body);
    }
}
