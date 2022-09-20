<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Exceptions\Totp;

use InvalidArgumentException;
use Worksome\MultiFactorAuth\Exceptions\MultiFactorAuthException;

class InvalidTotpSecretException extends InvalidArgumentException implements MultiFactorAuthException
{
}
