# PHP Pocket API

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A PHP client for the [Pocket](https://getpocket.com) API.

## Install

Via Composer

``` bash
$ composer require arianrashidi/pocketapi
```

## Usage

``` php
$pocket = new ArianRashidi\PocketApi\Pocket($consumerKey);
```

### Helpers
``` php
$pocket->setConsumerKey($consumerKey);
$pocket->getConsumerKey();
$pocket->setAccessToken($accessToken); // Required for addApi(), modifyApi() and retrieveApi().
$pocket->getAccessToken();
$pocket->setHttpClient(new GuzzleHttp\Client());
$pocket->getHttpClient();
```

### Authentication API
[Documentation](https://getpocket.com/developer/docs/authentication)

``` php
$pocket->authenticationApi()->obtainRequestToken($redirectUrl);
$pocket->authenticationApi()->authorizationUrl($requestToken, $redirectUrl);
$pocket->authenticationApi()->obtainAccess($requestToken);
```

### Add API
[Documentation](https://getpocket.com/developer/docs/v3/add)

``` php
$pocket->addApi()->single($url);
```

### Modify API
[Documentation](https://getpocket.com/developer/docs/v3/modify)

``` php
$pocket->modifyApi()->send($actions);
```

### Retrieve API
[Documentation](https://getpocket.com/developer/docs/v3/retrieve)

``` php
$pocket->retrieveApi()->get();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Credits

- Arian Rashidi
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/arianrashidi/pocketapi.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/arianrashidi/pocketapi/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/arianrashidi/pocketapi.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/arianrashidi/pocketapi.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/arianrashidi/pocketapi.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/arianrashidi/pocketapi
[link-travis]: https://travis-ci.org/arianrashidi/pocketapi
[link-scrutinizer]: https://scrutinizer-ci.com/g/arianrashidi/pocketapi/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/arianrashidi/pocketapi
[link-downloads]: https://packagist.org/packages/arianrashidi/pocketapi
[link-contributors]: ../../contributors
