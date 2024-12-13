<?php

namespace App\Models;

use App\Models\Scopes\AudienceScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

#[ScopedBy(AudienceScope::class)]
class Audience extends Model
{
    use Searchable;

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
