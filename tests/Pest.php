<?php

use Illuminate\Http\Client\Factory;
use Worksome\MultiFactorAuth\Drivers\TwilioVerifyDriver;
use Worksome\MultiFactorAuth\Tests\Factories\Http\TwilioVerify\TwilioVerifyHttpFactory;
use Worksome\MultiFactorAuth\Tests\TestCase;

uses(TestCase::class)->in('Feature');

function twilioVerifyDriver(Factory|null $client = null, string $region = 'eu', array $options = []): TwilioVerifyDriver
{
    return new TwilioVerifyDriver(
        $client ?? TwilioVerifyHttpFactory::new()->create(),
        $_ENV['TWILIO_VERIFY_SERVICE_ID'] ?? '1234',
        $_ENV['TWILIO_VERIFY_TOKEN'] ?? 'password',
    );
}
