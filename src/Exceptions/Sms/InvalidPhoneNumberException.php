<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Exceptions\Sms;

use InvalidArgumentException;
use Worksome\MultiFactorAuth\Exceptions\MultiFactorAuthException;

class InvalidPhoneNumberException extends InvalidArgumentException implements MultiFactorAuthException
{
}
