<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Managers;

use Illuminate\Cache\Repository;
use Illuminate\Support\Manager;
use PragmaRX\Google2FA\Google2FA;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsTotp;
use Worksome\MultiFactorAuth\Drivers\Totp\BasicTotpDriver;
use Worksome\MultiFactorAuth\Drivers\Totp\NullTotpDriver;
use Worksome\MultiFactorAuth\Enums\Channel;

/**
 * @method SupportsTotp driver(string|null $driver = null)
 */
final class MultiFactorTotpManager extends Manager
{
    public function getDefaultDriver(): string
    {
        // @phpstan-ignore-next-line
        return $this->config->get(sprintf('mfa.channels.%s.driver', Channel::Totp->value), 'null');
    }

    public function createNullDriver(): NullTotpDriver
    {
        return new NullTotpDriver();
    }

    public function createBasicDriver(): BasicTotpDriver
    {
        /** @var Google2FA $engine */
        $engine = $this->container->make(Google2FA::class);

        /** @var Repository $cache */
        $cache = $this->container->make(Repository::class);

        return new BasicTotpDriver($engine, $cache);
    }
}
