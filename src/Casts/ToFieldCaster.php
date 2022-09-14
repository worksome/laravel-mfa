<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Exceptions\InvalidValueException;
use Worksome\MultiFactorAuth\Models\MultiFactor;

class ToFieldCaster implements CastsAttributes
{
    /** @param MultiFactor $model */
    public function get($model, string $key, $value, array $attributes)
    {
        if (! is_string($value)) {
            throw new InvalidValueException('The given value is not a valid email address or E.164 phone number string.');
        }

        return match($model->channel) {
            Channel::EMAIL => new EmailAddress($value),
            Channel::SMS => new E164PhoneNumber($value),
        };
    }

    /** @param MultiFactor $model */
    public function set($model, string $key, $value, array $attributes)
    {
        if (! $value instanceof EmailAddress && ! $value instanceof E164PhoneNumber) {
            throw new InvalidArgumentException('The given value is not an E.164 Phone Number or Email Address instance.');
        }

        return $value->value;
    }
}
