<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DataValues\Email;

use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\Exceptions\Email\InvalidEmailAddressException;

/** @link https://datatracker.ietf.org/doc/html/rfc5322 */
class EmailAddress extends Identifier
{
    public function __construct(public readonly string $data)
    {
        if (! filter_var($this->data, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailAddressException(
                'The provided email address is not valid.'
            );
        }
    }
}
