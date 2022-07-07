<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\Sms\SmsCreationResponse;
use Worksome\MultiFactorAuth\Drivers\NullDriver;
use Worksome\MultiFactorAuth\Enums\Sms\Status as SmsStatus;
use Worksome\MultiFactorAuth\Facades\MultiFactorAuth as MultiFactorAuthFacade;

it('can create a driver from the facade', function () {
    MultiFactorAuthFacade::usingDriver(new NullDriver());

    $response = MultiFactorAuthFacade::sendSms(new E164PhoneNumber('+15017122661'));

    expect($response)
        ->toBeInstanceOf(SmsCreationResponse::class)
        ->status->toBe(SmsStatus::PENDING);
});
