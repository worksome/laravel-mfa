<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\Enums\Status;

it('can create a valid creation response', function (Status $status, array $data) {
    expect(new CreationResponse($status, $data))
        ->toBeInstanceOf(CreationResponse::class)
        ->status->toBe($status)
        ->data->toBe($data);
})->with([
    'status' => [Status::APPROVED, []],
    'status and data' => [Status::APPROVED, ['valid' => true]],
]);
