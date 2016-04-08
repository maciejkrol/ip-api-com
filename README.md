# ip-api-com

Simple PHP wrapper for http://ip-api.com/

## Installation

[![Latest Stable Version](https://img.shields.io/packagist/v/maciejkrol/ipapicom.svg?style=flat-square)](https://packagist.org/packages/maciejkrol/ipapicom)

Package is available on [Packagist](http://packagist.org/packages/lcobucci/jwt),
you can install it using [Composer](http://getcomposer.org).

```shell
composer require maciejkrol/ipapicom
```

## Basic usage

```php
use maciejkrol\ipapicom;

$ipapi = new ipapi ('ACCESS KEY');
$location = $ipapi->locate ('127.0.0.1');

```
