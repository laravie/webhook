<?php

namespace Laravie\Webhook\Tests;

use Laravie\Webhook\Request;
use PHPUnit\Framework\TestCase;
use Laravie\Codex\Contracts\Endpoint;

class RequestTest extends TestCase
{
    /** @test */
    public function it_can_create_instance_of_endpoint()
    {
        $stub = Request::to('https://laravel.com/docs/5.4?search=controller');
        $this->assertInstanceOf(Endpoint::class, $stub);
        $this->assertSame('https://laravel.com', $stub->getUri());
        $this->assertSame(['docs', '5.4'], $stub->getPath());
        $this->assertSame(['search' => 'controller'], $stub->getQuery());
    }
}
