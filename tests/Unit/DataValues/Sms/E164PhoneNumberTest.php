<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\Exceptions\Sms\InvalidPhoneNumberException;

it('can create a valid E.164 phone number', function () {
    expect(new E164PhoneNumber('+442071838750'))
        ->toBeInstanceOf(E164PhoneNumber::class)
        ->number->toBe('+442071838750');
});

it('throws an exception for a non-E.164 phone number', function (string $number) {
    new E164PhoneNumber($number);
})
    ->throws(InvalidPhoneNumberException::class, 'The provided phone number does not match E.164 formatting.')
    ->with([
        'number that has no +' => '442071838750',
        'number that has only +' => '+',
        'number that is too short' => '+1',
        'number that is too long' => '44207183875000000',
    ]);
