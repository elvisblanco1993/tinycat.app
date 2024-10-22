<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

#[ScopedBy(ClientScope::class)]
class Client extends Model
{
    use HasFactory, Searchable, SoftDeletes, Notifiable;

    protected $guarded = [];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(Form::class)->withTimestamps();
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'client_id');
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'client_id')->orderBy('updated_at', 'desc');
    }
}
