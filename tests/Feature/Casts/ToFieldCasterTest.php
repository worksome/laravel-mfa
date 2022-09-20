<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Models\MultiFactor;

it('can cast from cents to a number', function (Channel $channel, E164PhoneNumber|EmailAddress $to) {
    /** @var MultiFactor $factor */
    $factor = MultiFactor::query()->create([
        'name' => 'Test',
        'channel' => $channel,
        'to' => $to,
        'user_id' => 1,
        'status' => Status::PENDING,
    ])->refresh();

    expect($factor->channel)->toEqual($channel)
        ->and($factor->to)->toEqual($to);
})->with([
    [Channel::Email, new EmailAddress('test@example.org')],
    [Channel::Sms, new E164PhoneNumber('+15017122661')],
]);

it('throws an exception for invalid E164 Phone Number', function () {
    MultiFactor::query()->create([
        'channel' => Channel::Sms,
        'to' => '+15017122661',
    ]);
})->throws(InvalidArgumentException::class, 'The given value is not an E.164 Phone Number or Email Address instance.');

it('throws an exception for invalid Email Address', function () {
    MultiFactor::query()->create([
        'channel' => Channel::Email,
        'to' => 'invalid',
    ]);
})->throws(InvalidArgumentException::class, 'The given value is not an E.164 Phone Number or Email Address instance.');
