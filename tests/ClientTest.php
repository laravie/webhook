<?php

namespace Laravie\Webhook\Tests;

use Laravie\Webhook\Client;
use Laravie\Webhook\Request;
use PHPUnit\Framework\TestCase;
use Laravie\Codex\Testing\Faker;

class ClientTest extends TestCase
{
    /** @test */
    public function it_has_proper_signature()
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

        /** @test */
    public function it_can_send_api_request_on_version_one()
    {
        $faker = Faker::create()
                    ->sendJson('POST', [], ['foo' => 'bar'])
                    ->expectEndpointIs('https://acme.laravie/webhook')
                    ->shouldResponseWith(200, 'OK');

        $request = new class() extends Request {
            public function ping()
            {
                return $this->send('https://acme.laravie/webhook', [], ['foo' => 'bar']);
            }
        };

        $client = new Client($faker->http());

        $response = $client->via($request)->ping();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getBody());
    }
}
