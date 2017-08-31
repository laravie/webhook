<?php

namespace Laravie\Webhook;

use Laravie\Request\Client as BaseClient;

class Client extends BaseClient
{
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
