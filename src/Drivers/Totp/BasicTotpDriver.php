<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Totp;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use PragmaRX\Google2FA\Google2FA;
use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\Drivers\AbstractTotpDriver;
use Worksome\MultiFactorAuth\Enums\Status;

class BasicTotpDriver extends AbstractTotpDriver
{
    public function __construct(private readonly Google2FA $engine, private readonly CacheRepository $cache)
    {
    }

    public function make(Identifier $to): CreationResponse
    {
        return new CreationResponse(Status::PENDING);
    }

    public function verify(Identifier $to, string $code): bool
    {
        $timestamp = $this->engine->verifyKeyNewer(
            $to->data,
            $code,
            $this->cache->get($key = 'mfa.mfa_codes.' . md5($code)) // @phpstan-ignore-line
        );

        if ($timestamp === false) {
            return false;
        }

        if ($timestamp === true) {
            $timestamp = $this->engine->getTimestamp();
        }

        $this->cache->put($key, $timestamp, 60);

        return true;
    }
}
