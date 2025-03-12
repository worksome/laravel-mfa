<?php

declare(strict_types=1);

use Illuminate\Http\Client\Factory;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Exceptions\InvalidValueException;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

it('can retrieve an SMS response from the Twilio Verify API', function () {
    $factory = new Factory();

    $factory->fake([
        '/v2/Services/*/Verifications' => json_decode(file_get_contents(
            getResponseStubFilePath('TwilioVerify/verifications/sms-approved.json')
        ), true),
    ]);

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111',
        'VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
    );

    $response = $client->sendVerification('+15017122661', Channel::Sms);

    expect($response)->toBeArray()
        ->sid->toBe('VEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
        ->to->toBe('+15017122661')
        ->channel->toBe(Channel::Sms->value);
});

it('can retrieve an SMS response from the Twilio Verify API check', function () {
    $factory = new Factory();

    $factory->fake([
        '/v2/Services/*/VerificationCheck' => json_decode(file_get_contents(
            getResponseStubFilePath('TwilioVerify/verifications/sms-verify-approved.json')
        ), true),
    ]);

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111',
        'VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
    );

    $response = $client->sendVerificationCheck('+15017122661', '123456');

    expect($response)->toBeArray()
        ->sid->toBe('VEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
        ->to->toBe('+15017122661')
        ->channel->toBe(Channel::Sms->value)
        ->status->toBe(Status::APPROVED->value);
});

it('can retrieve an Email response from the Twilio Verify API', function () {
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

    $response = $client->sendVerification('test@example.org', Channel::Email);

    expect($response)->toBeArray()
        ->sid->toBe('VEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
        ->to->toBe('test@example.org')
        ->channel->toBe(Channel::Email->value);
});

it('can retrieve an Email response from the Twilio Verify API check', function () {
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

    $response = $client->sendVerificationCheck('test@example.org', '123456');

    expect($response)->toBeArray()
        ->sid->toBe('VEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
        ->to->toBe('test@example.org')
        ->channel->toBe(Channel::Email->value)
        ->status->toBe(Status::APPROVED->value);
});

it('throws an exception when no service id is provided', function () {
    $factory = new Factory();

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111'
    );

    $client->sendVerification('+15017122661', Channel::Sms);
})->throws(
    InvalidValueException::class,
    'A valid service token is required for this Twilio Verify request, none provided.'
);
