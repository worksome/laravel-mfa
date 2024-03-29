<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Services\TwilioVerify;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Exceptions\InvalidValueException;
use Worksome\MultiFactorAuth\Exceptions\MultiFactorAuthException;

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

    /** @throws MultiFactorAuthException|RequestException */
    public function sendVerification(string $to, Channel $channel): array
    {
        $this->serviceIdRequired();

        try {
            return $this->client()->post("/v2/Services/{$this->serviceId}/Verifications", [
                'To' => $to,
                'Channel' => $channel->value,
            ])->throw()->json();
        } catch (RequestException $requestException) {
            (new TwilioExceptionHandler())->handleRequestException($requestException);
        }
    }

    /** @throws MultiFactorAuthException|RequestException */
    public function sendVerificationCheck(string $to, string $code): array
    {
        $this->serviceIdRequired();

        try {
            return $this->client()->post("/v2/Services/{$this->serviceId}/VerificationCheck", [
                'To' => $to,
                'Code' => $code,
            ])->throw()->json();
        } catch (RequestException $requestException) {
            (new TwilioExceptionHandler())->handleRequestException($requestException);
        }
    }

    private function client(): PendingRequest
    {
        return $this
            ->client
            ->baseUrl(self::BASE_URL)
            ->withBasicAuth($this->accountId, $this->token)
            ->acceptJson()
            ->asForm();
    }

    private function serviceIdRequired(): void
    {
        throw_if(
            $this->serviceId === null,
            InvalidValueException::class,
            'A valid service token is required for this Twilio Verify request, none provided.'
        );
    }
}
