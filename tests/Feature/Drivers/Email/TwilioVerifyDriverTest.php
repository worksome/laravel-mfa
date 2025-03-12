<?php

declare(strict_types=1);

use Illuminate\Http\Client\Factory;
use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\Drivers\Email\TwilioVerifyEmailDriver;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

it('can retrieve an Email Verification response from the Twilio Verify driver', function () {
    $factory = new Factory();

    $factory->fake([
        '/v2/Services/*/Verifications' => json_decode(file_get_contents(
            getResponseStubFilePath('TwilioVerify/verifications/email-approved.json')
        ), true),
    ]);

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111',
        'VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
    );

    $driver = new TwilioVerifyEmailDriver($client);

    $status = $driver->make(new EmailAddress('test@example.org'));

    expect($status)->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING)
        ->data->toBeArray()
        ->data->to->toBe('test@example.org')
        ->data->channel->toBe(Channel::Email->value)
        ->data->sid->toBe('VEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
        ->data->status->toBe(Status::PENDING->value);
});

it('can retrieve an Email Verification Check response from the Twilio Verify driver', function () {
    $factory = new Factory();

    $factory->fake([
        '/v2/Services/*/VerificationCheck' => json_decode(file_get_contents(
            getResponseStubFilePath('TwilioVerify/verifications/email-verify-approved.json')
        ), true),
    ]);

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111',
        'VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
    );

    $driver = new TwilioVerifyEmailDriver($client);

    expect($driver->verify(new EmailAddress('test@example.org'), '123456'))->toBeTrue();
});
