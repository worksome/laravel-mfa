<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth;

use Worksome\MultiFactorAuth\Contracts\Channels\ChannelDriver;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsEmail;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsSms;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Managers\MultiFactorEmailManager;
use Worksome\MultiFactorAuth\Managers\MultiFactorSmsManager;

/**
 * @method SupportsEmail email()
 * @method SupportsSms   sms()
 */
class MultiFactorAuth
{
    /** @var array<string, ChannelDriver<E164PhoneNumber>|ChannelDriver<EmailAddress>> $drivers */
    private array $drivers = [];

    public function __construct(
        private readonly MultiFactorSmsManager $smsManager,
        private readonly MultiFactorEmailManager $emailManager,
    ) {
    }

    /**
     * @param ChannelDriver<E164PhoneNumber>|ChannelDriver<EmailAddress> $driver
     */
    public function usingDriver(Channel $channel, ChannelDriver|null $driver): self
    {
        if ($driver === null) {
            unset($this->drivers[$channel->value]);

            return $this;
        }

        $this->drivers[$channel->value] = $driver;

        return $this;
    }

    /**
     * @param Channel $channel
     *
     * @return ($channel is Channel::Email ? ChannelDriver<EmailAddress> : ChannelDriver<E164PhoneNumber>)
     */
    public function driver(Channel $channel): ChannelDriver
    {
        return $this->drivers[$channel->value] ?? match ($channel) {
            Channel::Email => $this->emailManager->driver(),
            Channel::Sms => $this->smsManager->driver(),
        };
    }

    /**
     * @return ChannelDriver<E164PhoneNumber>|ChannelDriver<EmailAddress>
     */
    public function __call(string $name, array $arguments): ChannelDriver
    {
        return $this->driver(Channel::from($name));
    }
}
