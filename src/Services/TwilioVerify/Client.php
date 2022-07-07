<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Services\TwilioVerify;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Worksome\MultiFactorAuth\Enums\Sms\TwilioVerifyChannel;
use Worksome\MultiFactorAuth\Exceptions\BaseException;

class Client
{
    public const BASE_URL = 'https://verify.twilio.com';

    public function __construct(
        private readonly Factory $client,
        private readonly string $accountId,
        private readonly string $token,
        private readonly string|null $serviceId = null,
    ) {
    }

    public function forService(string $service): self
    {
        return new self($this->client, $this->accountId, $this->token, $service);
    }

    public function sendVerification(string $to, TwilioVerifyChannel $channel): array
    {
        $this->serviceIdRequired();

        $response = $this->client()->post("/v2/Services/{$this->serviceId}/Verifications", [
            'To' => $to,
            'Channel' => $channel->value,
        ])->throw()->json();

        return $response;
    }

    public function sendVerificationCheck(string $to, string $code): array
    {
        $this->serviceIdRequired();

        $response = $this->client()->post("/v2/Services/{$this->serviceId}/VerificationCheck", [
            'To' => $to,
            'Code' => $code,
        ])->throw()->json();

        return $response;
    }

    private function client(): PendingRequest
    {
        return $this
            ->client
            ->baseUrl(self::BASE_URL)
            ->withBasicAuth($this->accountId, $this->token)
            ->acceptJson()
            ->asJson();
    }

    private function serviceIdRequired(): void
    {
        throw_if(
            $this->serviceId === null,
            BaseException::class,
            'A valid service token is required for this Twilio Verify request, none provided.'
        );
    }
}
