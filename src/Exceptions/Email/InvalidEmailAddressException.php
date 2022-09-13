<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Exceptions\Email;

use InvalidArgumentException;
use Worksome\MultiFactorAuth\Exceptions\MultiFactorAuthException;

class InvalidEmailAddressException extends InvalidArgumentException implements MultiFactorAuthException
{
}
