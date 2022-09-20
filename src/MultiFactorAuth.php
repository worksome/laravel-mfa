<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth;

use Worksome\MultiFactorAuth\Contracts\Channels\ChannelDriver;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsEmail;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsSms;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsTotp;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Managers\MultiFactorEmailManager;
use Worksome\MultiFactorAuth\Managers\MultiFactorSmsManager;
use Worksome\MultiFactorAuth\Managers\MultiFactorTotpManager;

/**
 * @method SupportsEmail email()
 * @method SupportsSms   sms()
 * @method SupportsTotp  totp()
 *
 * @property-read SupportsEmail $email
 * @property-read SupportsSms   $sms
 * @property-read SupportsTotp  $totp
 */
class MultiFactorAuth
{
    /** @var array<string, ChannelDriver<E164PhoneNumber>|ChannelDriver<EmailAddress>|ChannelDriver<TotpSecret>> $drivers */
    private array $drivers = [];

    public function __construct(
        private readonly MultiFactorEmailManager $emailManager,
        private readonly MultiFactorSmsManager $smsManager,
        private readonly MultiFactorTotpManager $totpManager,
    ) {
    }

    /**
     * @param ChannelDriver<E164PhoneNumber>|ChannelDriver<EmailAddress>|ChannelDriver<TotpSecret> $driver
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
     * @return ($channel is Channel::Email ? ChannelDriver<EmailAddress> : ($channel is Channel::Sms ? ChannelDriver<E164PhoneNumber> : ChannelDriver<TotpSecret>))
     */
    public function driver(Channel $channel): ChannelDriver
    {
        return $this->drivers[$channel->value] ?? match ($channel) {
            Channel::Email => $this->emailManager->driver(),
            Channel::Sms => $this->smsManager->driver(),
            Channel::Totp => $this->totpManager->driver(),
        };
    }

    /**
     * @return ChannelDriver<E164PhoneNumber>|ChannelDriver<EmailAddress>|ChannelDriver<TotpSecret>
     */
    public function __call(string $name, array $arguments): ChannelDriver
    {
        return $this->driver(Channel::from($name));
    }

    /**
     * @return ChannelDriver<E164PhoneNumber>|ChannelDriver<EmailAddress>|ChannelDriver<TotpSecret>
     */
    public function __get(string $name): ChannelDriver
    {
        return $this->driver(Channel::from($name));
    }
}
