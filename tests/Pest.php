<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\Tests\TestCase;

uses(TestCase::class)->in('Feature');

// Test functions

function getResponseStubFilePath(string|null $path = null): string
{
    return __DIR__ . "/stubs/{$path}";
}
