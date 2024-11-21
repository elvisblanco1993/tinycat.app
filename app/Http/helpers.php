<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

if (!function_exists('teamUsers')) {
    function teamUsers()
    {
        $team = Auth::user()->currentTeam;

        return Cache::remember("users_for_team_{$team->id}", now()->addMinutes(30), function () use ($team) {
            return User::select('id', 'name', 'profile_photo_path')
                ->where('current_team_id', $team->id)
                ->orWhereHas('ownedClient', function ($q) use ($team) {
                    $q->where('team_id', $team->id);
                })
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'profile_photo_url' => $user->profile_photo_url,
                        'disabled' => false,
                    ];
                })
                ->toArray();
        });
    }
}
