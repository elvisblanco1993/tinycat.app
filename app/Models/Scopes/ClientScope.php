<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ClientScope implements Scope
{
    /**
     * Only show to people under the assigned provider, or client.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('team_id', Auth::user()->current_team_id)
            ->orWhere('owner_id', Auth::id());
    }
}
