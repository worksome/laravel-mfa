<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\Sms\SmsCreationResponse;
use Worksome\MultiFactorAuth\Enums\Sms\Status as SmsStatus;

it('can create a valid SMS Creation response', function (SmsStatus $status, array $data) {
    expect(new SmsCreationResponse($status, $data))
        ->toBeInstanceOf(SmsCreationResponse::class)
        ->status->toBe($status)
        ->data->toBe($data);
})->with([
    'status' => [SmsStatus::APPROVED, []],
    'status and data' => [SmsStatus::APPROVED, ['valid' => true]],
]);
