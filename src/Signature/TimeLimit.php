<?php

namespace Laravie\Webhook\Signature;

use Laravie\Webhook\Contracts\Signature;

class TimeLimit implements Signature
{
    /**
     * Signature secret.
     *
     * @var string
     */
    protected $secret;

    /**
     * Signature timestamp.
     *
     * @var int
     */
    protected $timestamp;

    /**
     * Hasher used.
     *
     * @var string
     */
    protected $hasher;

    /**
     * Construct a new signature.
     *
     * @param string  $secret
     * @param int  $timestamp
     * @param string  $hasher
     */
    public function __construct(string $secret, int $timestamp, string $hasher = 'sha256')
    {
        $this->secret = $secret;
        $this->timestamp = $timestamp;
        $this->hasher = $hasher;
    }

    /**
     * Create signature.
     *
     * @param  string  $content
     *
     * @return string
     */
    public function create(string $content): string
    {
        $timestamp = (string) $this->timestamp;

        $payload = "{$timestamp}.{$content}";
        $signature = \hash_hmac($this->hasher, $payload, $this->secret);

        return "t={$timestamp},v1={$signature}";
    }
}
