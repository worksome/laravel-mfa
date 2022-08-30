<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Exceptions;

use InvalidArgumentException;

class InvalidValueException extends InvalidArgumentException implements MultiFactorAuthException
{
}
