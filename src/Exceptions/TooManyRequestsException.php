<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Exceptions;

class TooManyRequestsException extends \RuntimeException implements MultiFactorAuthException
{
}
