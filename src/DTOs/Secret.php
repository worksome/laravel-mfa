<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DTOs;

class Secret
{
    public function __construct(
        public readonly string $secret,
        public readonly string|null $issuer = null,
        public readonly string|null $label = null,
        public readonly string|null $algorithm = null,
        public readonly int|null $digits = null,
        public readonly int|null $period = null,
        private readonly string|null $uri = null,
    ) {
    }

    public static function fromSecret(Secret $secret, array $values): self
    {
        return new self(...array_merge([
            'secret' => $secret->secret,
            'issuer' => $secret->issuer,
            'label' => $secret->label,
            'algorithm' => $secret->algorithm,
            'digits' => $secret->digits,
            'period' => $secret->period,
            'uri' => $secret->uri,
        ], $values));
    }

    public function getUri(): string
    {
        return $this->uri ?? sprintf(
            'otpauth://totp/%s?secret=%s%s%s%s%s',
            urlencode($this->issuer ?? 'Unknown') . ($this->label ? ':' . urlencode($this->label) : null),
            $this->secret,
            $this->issuer ? "&issuer={$this->issuer}" : null,
            $this->algorithm ? "&algorithm={$this->algorithm}" : null,
            $this->digits ? "&digits={$this->digits}" : null,
            $this->period ? "&period={$this->period}" : null,
        );
    }
}
