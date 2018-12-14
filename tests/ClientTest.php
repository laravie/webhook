<?php

namespace Laravie\Webhook\Tests;

use Laravie\Webhook\Client;
use PHPUnit\Framework\TestCase;
use Laravie\Codex\Testing\Faker;

class ClientTest extends TestCase
{
    /** @test */
    public function it_can_be_initiated()
    {
        $stub = new Client(Faker::create()->http());

        $this->assertInstanceOf(Client::class, $stub);
        $this->assertSame('application/json', $stub->getContentType());
    }

    /** @test */
    public function it_can_set_custom_content_type()
    {
        $stub = new Client(Faker::create()->http());
        $stub->setContentType('application/xml');

        $this->assertSame('application/xml', $stub->getContentType());
    }
}
