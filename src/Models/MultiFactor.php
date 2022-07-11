<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Worksome\MultiFactorAuth\Contracts\MultiFactorAuthenticatable;
use Worksome\MultiFactorAuth\Exceptions\BaseException;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 */
class MultiFactor extends Model
{
    public function user(): BelongsTo
    {
        /** @var class-string<MultiFactorAuthenticatable>|null $userModel */
        $userModel = config('mfa.user');

        if (! $userModel || ! class_exists($userModel)) {
            throw new BaseException("Class '{$userModel}' must exist.");
        }

        if (! Arr::exists((array) class_implements($userModel), MultiFactorAuthenticatable::class)) {
            throw new BaseException("Class '{$userModel}' must implement '".MultiFactorAuthenticatable::class."'.");
        }

        return $this->belongsTo($userModel);
    }
}
