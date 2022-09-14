<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DataValues\Sms;

use Worksome\MultiFactorAuth\Exceptions\Sms\InvalidPhoneNumberException;

/** @link https://itu.int/rec/T-REC-E.164 */
class E164PhoneNumber
{
    public function __construct(public readonly string $value)
    {
        if (! preg_match('/^\+[1-9]\d{1,14}$/ui', $this->value)) {
            throw new InvalidPhoneNumberException(
                'The provided phone number does not match E.164 formatting.'
            );
        }
    }
}
