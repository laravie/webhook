Webhook Client for PHP
==============

[![Build Status](https://travis-ci.org/laravie/webhook.svg?branch=master)](https://travis-ci.org/laravie/webhook)
[![Latest Stable Version](https://poser.pugx.org/laravie/webhook/v/stable)](https://packagist.org/packages/laravie/webhook)
[![Total Downloads](https://poser.pugx.org/laravie/webhook/downloads)](https://packagist.org/packages/laravie/webhook)
[![Latest Unstable Version](https://poser.pugx.org/laravie/webhook/v/unstable)](https://packagist.org/packages/laravie/webhook)
[![License](https://poser.pugx.org/laravie/webhook/license)](https://packagist.org/packages/laravie/webhook)
[![Coverage Status](https://coveralls.io/repos/github/laravie/webhook/badge.svg?branch=master)](https://coveralls.io/github/laravie/webhook?branch=master)

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "laravie/webhook": "^2.0",
        "php-http/curl-client": "^2.0"
    }
}
```

And then run `composer install` from the terminal.

### Quick Installation

Above installation can also be simplify by using the following command:

    composer require "php-http/curl-client" "laravie/webhook=^2.0"

### HTTP Adapter

Instead of utilizing `php-http/curl-client` you might want to use any other adapter that implements `php-http/client-implementation`. Check [Clients & Adapters](http://docs.php-http.org/en/latest/clients.html) for PHP-HTTP.
