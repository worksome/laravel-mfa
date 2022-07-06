<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts;

use Worksome\MultiFactorAuth\DTOs\Secret;

interface Driver
{
    public function getSecret(): Secret;
}
