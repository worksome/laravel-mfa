<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 */
class MultiFactor extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('mfa.user'));
    }
}
