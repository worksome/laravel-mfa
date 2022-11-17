<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Services\TwilioVerify;

use Illuminate\Http\Client\RequestException;
use Worksome\MultiFactorAuth\Exceptions\FraudDetectionTriggeredException;
use Worksome\MultiFactorAuth\Exceptions\MultiFactorAuthException;
use Worksome\MultiFactorAuth\Exceptions\Sms\ExpiredCodeException;
use Worksome\MultiFactorAuth\Exceptions\Sms\UnsupportedLocationException;
use Worksome\MultiFactorAuth\Exceptions\TooManyRequestsException;

class TwilioExceptionHandler
{
    /** @throws MultiFactorAuthException|RequestException */
    public function handleRequestException(RequestException $exception): never
    {
        $errorCode = $exception->response->json('code');

        throw match ($errorCode) {
            20404 => new ExpiredCodeException(),
            60203 => new TooManyRequestsException(),
            60410 => new FraudDetectionTriggeredException(),
            60505 => new UnsupportedLocationException(),
            default => $exception,
        };
    }
}
