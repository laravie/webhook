Webhook Client for PHP
==============

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "laravie/webhook": "~1.0",
        "php-http/curl-client": "^1.7 || ^2.0"
    }
}
```

And then run `composer install` from the terminal.

### Quick Installation

Above installation can also be simplify by using the following command:

    composer require "laravie/webhook=~1.0"

### HTTP Adapter

Instead of utilizing `php-http/curl-client` you might want to use any other adapter that implements `php-http/client-implementation`. Check [Clients & Adapters](http://docs.php-http.org/en/latest/clients.html) for PHP-HTTP.
