<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Managers;

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Manager;
use Worksome\MultiFactorAuth\Drivers\NullDriver;
use Worksome\MultiFactorAuth\Drivers\TwilioVerifyDriver;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

final class MultiFactorManager extends Manager
{
    public function getDefaultDriver(): string
    {
        // @phpstan-ignore-next-line
        return $this->config->get('mfa.default') ?? 'null';
    }

    public function createNullDriver(): NullDriver
    {
        return new NullDriver();
    }

    public function createTwilioVerifyDriver(): TwilioVerifyDriver
    {
        /** @var array{account_id: string, token: string, service_id: string|null} $options */
        $options = $this->config->get('mfa.services.twilio_verify');

        /** @var Factory $factory */
        $factory = $this->container->make(Factory::class);

        return new TwilioVerifyDriver(
            new Client(
                $factory,
                $options['account_id'],
                $options['token'],
                $options['service_id'],
            )
        );
    }
}
