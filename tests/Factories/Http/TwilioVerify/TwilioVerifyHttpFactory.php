<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Tests\Factories\Http\TwilioVerify;

use Illuminate\Events\Dispatcher;
use Illuminate\Http\Client\Factory;
use InvalidArgumentException;

final class TwilioVerifyHttpFactory
{
    private Dispatcher $event;

    private Factory $client;

    public function __construct()
    {
        $this->event = new Dispatcher();
        $this->client = new Factory($this->event);
    }

    public static function new(): self
    {
        return new self();
    }

    public function create(): Factory
    {
        if (! file_exists($this->getResponseStubFilePath())) {
            throw new InvalidArgumentException("[{$this->getResponseStubFilePath()}] does not exist as a stubbed response. You may need to create it.");
        }

        return $this->client->fake([
            'https://verify.twilio.com/v2/services/*/entities/*/factors' => json_decode(file_get_contents($this->getResponseStubFilePath()), true)
        ]);
    }

    private function getResponseStubFilePath(): string
    {
        return __DIR__ . "/../../../Stubs/Http/TwilioVerify/response.json";
    }
}
