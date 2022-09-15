<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth;

use Worksome\MultiFactorAuth\Contracts\Channels\ChannelDriver;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsEmail;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsSms;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Managers\MultiFactorEmailManager;
use Worksome\MultiFactorAuth\Managers\MultiFactorSmsManager;

/**
 * @method SupportsEmail email()
 * @method SupportsSms sms()
 */
class MultiFactorAuth
{
    /** @var array<string, ChannelDriver> $drivers */
    private array $drivers = [];

    public function __construct(
        private readonly MultiFactorSmsManager $smsManager,
        private readonly MultiFactorEmailManager $emailManager
    ) {
    }

    public function usingDriver(Channel $channel, ChannelDriver|null $driver): self
    {
        if ($driver === null) {
            unset($this->drivers[$channel->value]);

            return $this;
        }

        $this->drivers[$channel->value] = $driver;

        return $this;
    }

    private function driver(Channel $channel): ChannelDriver
    {
        // @phpstan-ignore-next-line
        return $this->drivers[$channel->value] ?? match ($channel) {
            Channel::EMAIL => $this->emailManager->driver(),
            Channel::SMS => $this->smsManager->driver(),
        };
    }

    public function __call(string $name, array $arguments): ChannelDriver
    {
        return $this->driver(Channel::from($name));
    }
}
