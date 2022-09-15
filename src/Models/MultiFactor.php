<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Worksome\MultiFactorAuth\Casts\ToFieldCaster;
use Worksome\MultiFactorAuth\Contracts\MultiFactorAuthenticatable;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Exceptions\InvalidMultiFactorAuthenticatableException;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property EmailAddress|E164PhoneNumber $to
 * @property Channel $channel
 * @property Status $status
 * @property Carbon|null $verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property MultiFactorAuthenticatable&Model $user
 */
class MultiFactor extends Model
{
    protected $table = 'mfa_multi_factors';

    protected $guarded = [];

    protected $casts = [
        'channel' => Channel::class,
        'status' => Status::class,
        'to' => ToFieldCaster::class,
        'verified_at' => 'datetime',
    ];

    /** @return BelongsTo<self, MultiFactorAuthenticatable&Model> */
    public function user(): BelongsTo
    {
        /** @var class-string<MultiFactorAuthenticatable&Model>|null $userModel */
        $userModel = config('mfa.user');

        if (! $userModel || ! class_exists($userModel)) {
            throw new InvalidMultiFactorAuthenticatableException("Class '{$userModel}' must exist.");
        }

        if (! Arr::exists((array) class_implements($userModel), MultiFactorAuthenticatable::class)) {
            throw new InvalidMultiFactorAuthenticatableException("Class '{$userModel}' must implement '".MultiFactorAuthenticatable::class."'.");
        }

        return $this->belongsTo($userModel);
    }
}
