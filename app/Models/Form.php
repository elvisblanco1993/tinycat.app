<?php

namespace App\Models;

use App\Models\Scopes\FormScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ScopedBy(FormScope::class)]
class Form extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class)->withTimestamps();
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)
            ->orderBy('order')
            ->chaperone();
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class)->chaperone();
    }
}
