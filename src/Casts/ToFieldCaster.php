<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Exceptions\InvalidValueException;
use Worksome\MultiFactorAuth\Models\MultiFactor;

class ToFieldCaster implements CastsAttributes
{
    /** @param MultiFactor $model */
    public function get($model, string $key, $value, array $attributes)
    {
        if (! is_string($value)) {
            throw new InvalidValueException(
                'The given value is not a valid email address, E.164 phone number, or TOTP secret string.'
            );
        }

        return match ($model->channel) {
            Channel::Email => new EmailAddress($value),
            Channel::Sms => new E164PhoneNumber($value),
            Channel::Totp => new TotpSecret($value),
        };
    }

    /** @param MultiFactor $model */
    public function set($model, string $key, $value, array $attributes)
    {
        if (! $value instanceof EmailAddress && ! $value instanceof E164PhoneNumber && ! $value instanceof TotpSecret) {
            throw new InvalidArgumentException('The given value is not a valid multi-factor identifier instance.');
        }

        return $value->data;
    }
}
