<?php

namespace App\Models;

use App\Models\Scopes\AudienceScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ScopedBy(AudienceScope::class)]
class Audience extends Model
{
    protected $guarded = [];

    public function leads(): BelongsToMany
    {
        return $this->belongsToMany(Lead::class)->withTimestamps();
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
