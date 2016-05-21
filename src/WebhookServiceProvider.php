<?php

namespace Laravie\Webhook;

use Http\Discovery\HttpClientDiscovery;
use Illuminate\Support\ServiceProvider;
use Http\Client\Common\HttpMethodsClient;
use Http\Discovery\MessageFactoryDiscovery;

class WebhookServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    abstract public function register()
    {
        $this->app->singleton('laravie.webhook', function ($app) {
            $client = new HttpMethodsClient(
                HttpClientDiscovery::find(),
                MessageFactoryDiscovery::find()
            );

            return Client($client);
        });
    }
}
