<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Exceptions\Sms;

use Worksome\MultiFactorAuth\Exceptions\MultiFactorAuthException;

class ExpiredCodeException extends \RuntimeException implements MultiFactorAuthException
{
}
