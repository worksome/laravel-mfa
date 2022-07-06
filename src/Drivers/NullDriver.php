<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Worksome\MultiFactorAuth\Contracts\Driver;
use Worksome\MultiFactorAuth\DTOs\Secret;

class NullDriver implements Driver
{
    public function __construct(private Secret $secret)
    {
    }

    public static function make(string $secret): self
    {
        return new self(
            new Secret($secret)
        );
    }

    public function getSecret(): Secret
    {
        return $this->secret;
    }

    public function with(array $parameters): self
    {
        $parameters = array_filter($parameters, fn ($key) => in_array($key, [
            'secret', 'issuer', 'label', 'algorithm', 'digits', 'period', 'uri'
        ]), ARRAY_FILTER_USE_KEY);

        $this->secret = Secret::fromSecret($this->secret, $parameters);

        return $this;
    }

    public function withSecret(Secret $secret): self
    {
        $this->secret = $secret;

        return $this;
    }
}
