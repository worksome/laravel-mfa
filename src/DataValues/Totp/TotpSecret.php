<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DataValues\Totp;

use Worksome\MultiFactorAuth\Enums\HashAlgorithm;

class TotpSecret
{
    public function __construct(
        public readonly string $secret,
        public readonly string $issuer,
        public readonly string $label,
        public readonly HashAlgorithm|null $algorithm,
        public readonly int|null $digits,
        public readonly int|null $period,
        private readonly string|null $uri = null,
    ) {
    }

    public function uri(): string
    {
        return $this->uri ?? sprintf(
            'otpauth://totp/%s:%s?secret=%s&issuer=%s%s%s%s',
            rawurlencode($this->issuer),
            rawurlencode($this->label),
            rawurlencode($this->secret),
            rawurlencode($this->issuer),
            $this->algorithm ? "&algorithm={$this->algorithm->value}" : null,
            $this->digits ? "&digits={$this->digits}" : null,
            $this->period ? "&period={$this->period}" : null,
        );
    }
}
