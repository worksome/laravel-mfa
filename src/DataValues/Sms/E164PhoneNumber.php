<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DataValues\Sms;

use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\Exceptions\Sms\InvalidPhoneNumberException;

/** @link https://itu.int/rec/T-REC-E.164 */
class E164PhoneNumber extends Identifier
{
    public function __construct(public readonly string $data)
    {
        if (! preg_match('/^\+[1-9]\d{1,14}$/ui', $this->data)) {
            throw new InvalidPhoneNumberException(
                'The provided phone number does not match E.164 formatting.'
            );
        }
    }
}
