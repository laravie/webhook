<?php

namespace Laravie\Webhook\Contracts;

interface Signature
{
    /**
     * Create signature.
     *
     * @param  string  $content
     *
     * @return string
     */
    public function create(string $content): string;
}
