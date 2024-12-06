<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

if (!function_exists('teamUsers')) {
    function teamUsers()
    {
        $team = Auth::user()->currentTeam;

        return Cache::remember("users_for_team_{$team->id}", now()->addMinutes(1), function () use ($team) {
            return User::select('id', 'name', 'profile_photo_path')
                ->where('current_team_id', $team->id)
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'profile_photo_url' => $user->profile_photo_url,
                        'profile_photo_path' => $user->profile_photo_path,
                        'disabled' => false,
                    ];
                })
                ->toArray();
        });
    }
}

/**
 * Get the users assigned to a client's account.
 */
if (!function_exists('clientUsers')) {
    function clientUsers(\App\Models\Client $client)
    {

        return Cache::remember("users_for_client_{$client->id}", now()->addMinutes(5), function () use ($client) {
            // Get client users
            $clientUsers = $client->users()->select('users.id', 'users.name', 'users.profile_photo_path')
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'profile_photo_url' => $user->profile_photo_url,
                        'disabled' => false,
                    ];
                });

            // Get owner
            $owner = $client->owner()->select('id', 'name', 'profile_photo_path')->first();
            if ($owner) {
                $clientUsers->prepend([
                    'id' => $owner->id,
                    'name' => $owner->name,
                    'profile_photo_url' => $owner->profile_photo_url,
                    'disabled' => false, // Optionally, you can set a flag to differentiate the owner
                ]);
            }
            return $clientUsers->toArray();
        });
    }
}

