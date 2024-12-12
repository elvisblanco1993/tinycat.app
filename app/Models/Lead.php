<?php

namespace App\Models;

use App\Models\Scopes\LeadScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

#[ScopedBy(LeadScope::class)]
class Lead extends Model
{
    use Notifiable, Searchable;

    protected $guarded = [];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company_name' => $this->company_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function audiences(): BelongsToMany
    {
        return $this->belongsToMany(Audience::class)->withTimestamps();
    }
}
