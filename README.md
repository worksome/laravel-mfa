# Laravel Multi-Factor Authentication

[![Latest Version on Packagist](https://img.shields.io/packagist/v/worksome/laravel-mfa.svg?style=flat-square)](https://packagist.org/packages/worksome/laravel-mfa)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/worksome/laravel-mfa/run-tests?label=tests)](https://github.com/worksome/laravel-mfa/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/worksome/laravel-mfa/Check%20&%20fix%20styling?label=code%20style)](https://github.com/worksome/laravel-mfa/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/worksome/laravel-mfa.svg?style=flat-square)](https://packagist.org/packages/worksome/laravel-mfa)

A driver-based multifactor authentication package for Laravel

## Installation

You can install the package via composer:

```bash
composer require worksome/laravel-mfa
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-mfa-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-mfa-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-mfa-views"
```

## Usage

```php
$twoFactorAuth = new Worksome\TwoFactorAuth();
echo $twoFactorAuth->echoPhrase('Hello, Worksome!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Owen Voke](https://github.com/worksome)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
