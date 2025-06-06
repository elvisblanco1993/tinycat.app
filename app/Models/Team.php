<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
        'size',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_team' => 'boolean',
        ];
    }

    public function itemTemplates(): HasMany
    {
        return $this->hasMany(ItemTemplate::class)->chaperone();
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class)->chaperone();
    }

    public function clientUsers(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Client::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class)->chaperone();
    }

    public function audiences(): HasMany
    {
        return $this->hasMany(Audience::class)->chaperone();
    }

    public function email_broadcasts(): HasMany
    {
        return $this->hasMany(EmailBroadcast::class)->chaperone();
    }
}
