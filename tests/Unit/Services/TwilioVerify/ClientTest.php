<?php

declare(strict_types=1);

use Illuminate\Http\Client\Factory;
use Worksome\MultiFactorAuth\Enums\Sms\Status;
use Worksome\MultiFactorAuth\Enums\Sms\TwilioVerifyChannel;
use Worksome\MultiFactorAuth\Exceptions\BaseException;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

it('can retrieve an SMS response from the Twilio Verify API', function () {
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

    $response = $client->sendVerification('+15017122661', TwilioVerifyChannel::SMS);

    expect($response)->toBeArray()
        ->sid->toBe('VEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
        ->to->toBe('+15017122661')
        ->channel->toBe('sms');
});

it('can retrieve an SMS response from the Twilio Verify API check', function () {
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

    $response = $client->sendVerificationCheck('+15017122661', '123456');

    expect($response)->toBeArray()
        ->sid->toBe('VEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
        ->to->toBe('+15017122661')
        ->channel->toBe('sms')
        ->status->toBe(Status::APPROVED->value);
});

it('throws an exception when no service id is provided', function () {
    $factory = new Factory();

    $client = new Client(
        $factory,
        'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'aaaabbbbccccddddeeeeffff1111'
    );

    $client->sendVerification('+15017122661', TwilioVerifyChannel::SMS);
})->throws(
    BaseException::class,
    'A valid service token is required for this Twilio Verify request, none provided.'
);
