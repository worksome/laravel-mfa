<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Managers;

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Manager;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsEmail;
use Worksome\MultiFactorAuth\Drivers\Email\NullEmailDriver;
use Worksome\MultiFactorAuth\Drivers\Email\TwilioVerifyEmailDriver;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

/**
 * @method SupportsEmail driver(string|null $driver = null)
 */
final class MultiFactorEmailManager extends Manager
{
    public function getDefaultDriver(): string
    {
        // @phpstan-ignore-next-line
        return $this->config->get(sprintf('mfa.channels.%s.driver', Channel::Email->value), 'null');
    }

    public function createNullDriver(): NullEmailDriver
    {
        return new NullEmailDriver();
    }

    public function createTwilioVerifyDriver(): TwilioVerifyEmailDriver
    {
        /** @var array{account_id: string, token: string, service_id: string|null} $options */
        $options = $this->config->get('mfa.services.twilio_verify');

        /** @var Factory $factory */
        $factory = $this->container->make(Factory::class);

        return new TwilioVerifyEmailDriver(
            new Client(
                $factory,
                $options['account_id'],
                $options['token'],
                $options['service_id'],
            )
        );
    }
}
