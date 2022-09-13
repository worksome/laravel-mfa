<?php

declare(strict_types=1);

use Illuminate\Http\Client\Factory;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\Drivers\TwilioVerifyDriver;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

it('can retrieve an SMS Verification response from the Twilio Verify driver', function () {
    $factory = new Factory();

    $factory->fake([
        '/v2/Services/*/Verifications' => json_decode(file_get_contents(
            getResponseStubFilePath('TwilioVerify/verifications/sms-approved.json')
        ), true)
    ]);

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111',
        'VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
    );

    $driver = new TwilioVerifyDriver($client);

    $status = $driver->sendSms(new E164PhoneNumber('+15017122661'));

    expect($status)->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING)
        ->data->toBeArray()
        ->data->to->toBe('+15017122661')
        ->data->channel->toBe(Channel::SMS->value)
        ->data->sid->toBe('VEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
        ->data->status->toBe(Status::PENDING->value);
});

it('can retrieve an SMS Verification Check response from the Twilio Verify driver', function () {
    $factory = new Factory();

    $factory->fake([
        '/v2/Services/*/VerificationCheck' => json_decode(file_get_contents(
            getResponseStubFilePath('TwilioVerify/verifications/sms-verify-approved.json')
        ), true)
    ]);

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111',
        'VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
    );

    $driver = new TwilioVerifyDriver($client);

    expect($driver->verifySms(new E164PhoneNumber('+15017122661'), '123456'))->toBeTrue();
});

it('can retrieve an Email Verification response from the Twilio Verify driver', function () {
    $factory = new Factory();

    $factory->fake([
        '/v2/Services/*/Verifications' => json_decode(file_get_contents(
            getResponseStubFilePath('TwilioVerify/verifications/email-approved.json')
        ), true)
    ]);

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111',
        'VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
    );

    $driver = new TwilioVerifyDriver($client);

    $status = $driver->sendEmail(new EmailAddress('test@example.org'));

    expect($status)->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING)
        ->data->toBeArray()
        ->data->to->toBe('test@example.org')
        ->data->channel->toBe(Channel::EMAIL->value)
        ->data->sid->toBe('VEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
        ->data->status->toBe(Status::PENDING->value);
});

it('can retrieve an Email Verification Check response from the Twilio Verify driver', function () {
    $factory = new Factory();

    $factory->fake([
        '/v2/Services/*/VerificationCheck' => json_decode(file_get_contents(
            getResponseStubFilePath('TwilioVerify/verifications/email-verify-approved.json')
        ), true)
    ]);

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111',
        'VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
    );

    $driver = new TwilioVerifyDriver($client);

    expect($driver->verifyEmail(new EmailAddress('test@example.org'), '123456'))->toBeTrue();
});
