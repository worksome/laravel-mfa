<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DataValues\Sms;

use Worksome\MultiFactorAuth\Enums\Sms\Status;

class SmsCreationResponse
{
    public function __construct(
        public readonly Status $status,
        public readonly array $data = [],
    ) {
    }
}
