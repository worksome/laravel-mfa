<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\RequestException;
use InvalidArgumentException;
use Worksome\MultiFactorAuth\Contracts\Driver;
use Worksome\MultiFactorAuth\DTOs\Secret;

final class TwilioVerifyDriver implements Driver
{
    public function __construct(
        private readonly Factory $client,
        private readonly string $serviceId,
        private readonly string $token,
    ) {
    }

    public function getSecret(string $identifier, string $label = null): Secret
    {
        $response = $this->makeRequest($identifier, $label);

        return new Secret(
            $response['binding']['secret'],
            null,
            $response['friendly_name'],
            $response['config']['alg'],
            $response['config']['code_length'],
            $response['config']['time_step'],
            $response['binding']['uri']
        );
    }

    /** @throws RequestException */
    private function makeRequest(string $identifier, string|null $friendlyName): array
    {
        $data = $this
            ->client
            ->baseUrl('https://verify.twilio.com/v2')
            ->acceptJson()
            ->asJson()
            ->withBasicAuth($this->serviceId, $this->token)
            ->post("services/{$this->serviceId}/entities/{$identifier}/factors", [
                'FriendlyName' => $friendlyName,
                'Type' => 'totp',
            ])
            ->throw()
            ->json();

        if (
            ! is_array($data)
            || ! isset(
                $data['binding']['secret'],
                $data['binding']['uri'],
                $data['identity'],
                $data['friendly_name'],
                $data['config']
            )
            || $data['identity'] !== $identifier
        ) {
            throw new InvalidArgumentException('The response from Twilio Verify was of an unexpected format.');
        }

        return $data;
    }
}
