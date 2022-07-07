<?php

use Worksome\MultiFactorAuth\Tests\TestCase;

uses(TestCase::class)->in('Feature');

function getResponseStubFilePath(string $path = null): string
{
    return __DIR__."/stubs/{$path}";
}
