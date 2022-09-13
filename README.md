# Laravel Multi-Factor Authentication

[![Latest Version on Packagist](https://img.shields.io/packagist/v/worksome/laravel-mfa.svg?style=flat-square)](https://packagist.org/packages/worksome/laravel-mfa)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/worksome/laravel-mfa/Tests?label=tests)](https://github.com/worksome/laravel-mfa/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/worksome/laravel-mfa/Static%20Analysis?label=code%20style)](https://github.com/worksome/laravel-mfa/actions?query=workflow%3A"Static+Analysis"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/worksome/laravel-mfa.svg?style=flat-square)](https://packagist.org/packages/worksome/laravel-mfa)

A driver-based multifactor authentication package for Laravel

## Installation

You can install the package via composer:

```bash
composer require worksome/laravel-mfa
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="mfa-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="mfa-config"
```

This is the contents of the published config file:

```php
return [

    /**
     * The user model to support multifactor authentication.
     */

    'user' => \App\Models\User::class,

    /**
     * Go ahead and select a default exchange driver to be used when
     * generating multifactor authentication.
     *
     * Supported: 'null', 'twilio_verify'
     */

    'default' => env('MFA_DRIVER', 'null'),

    'services' => [

        'twilio_verify' => [
            'account_id' => env('TWILIO_VERIFY_ACCOUNT_ID'),
            'token' => env('TWILIO_VERIFY_AUTH_TOKEN'),
            'service_id' => env('TWILIO_VERIFY_SERVICE_ID'),
        ],

    ],

];
```

## Usage

```php
$twoFactorAuth = new \Worksome\MultiFactorAuth\MultiFactorAuth();
$response = $twoFactorAuth->sendSms(
    new \Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber('+14155552671'),
);

dd($response);
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

- [Owen Voke](https://github.com/owenvoke)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
