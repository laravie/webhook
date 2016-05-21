<?php
namespace Laravie\Webhook\Facades;

use Illuminate\Support\Facades\Facade;

class Webhook extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravie.webhook';
    }
}
