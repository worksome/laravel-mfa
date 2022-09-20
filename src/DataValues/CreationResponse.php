<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DataValues;

use Worksome\MultiFactorAuth\Enums\Status;

class CreationResponse
{
    public function __construct(
        public readonly Status $status,
        public readonly array $data = [],
    ) {
    }
}
