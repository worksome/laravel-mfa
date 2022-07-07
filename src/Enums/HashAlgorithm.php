<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums;

enum HashAlgorithm: string
{
    case SHA1 = 'SHA1';
    case SHA256 = 'SHA256';
    case SHA512 = 'SHA512';
}
