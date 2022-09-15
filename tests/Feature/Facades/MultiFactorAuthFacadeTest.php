<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\Drivers\Email\NullEmailDriver;
use Worksome\MultiFactorAuth\Drivers\Sms\NullSmsDriver;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Facades\MultiFactorAuth;

it('can create an SMS driver from the facade', function () {
    MultiFactorAuth::usingDriver(Channel::SMS, new NullSmsDriver());

    $response = MultiFactorAuth::sms()->sendSms(new E164PhoneNumber('+15017122661'));

    expect($response)
        ->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});

it('can create an email driver from the facade', function () {
    MultiFactorAuth::usingDriver(Channel::EMAIL, new NullEmailDriver());

    $response = MultiFactorAuth::email()->sendEmail(new EmailAddress('test@example.org'));

    expect($response)
        ->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});
