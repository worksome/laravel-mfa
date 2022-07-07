<?php

use Worksome\MultiFactorAuth\Tests\TestCase;

uses(TestCase::class)->in(__DIR__ . '/Feature');

// Test functions

function getResponseStubFilePath(string $path = null): string
{
    return __DIR__ . "/stubs/{$path}";
}
