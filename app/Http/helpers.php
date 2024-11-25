<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

if (!function_exists('teamUsers')) {
    function teamUsers()
    {
        $team = Auth::user()->currentTeam;

        return Cache::remember("users_for_team_{$team->id}", now()->addMinutes(5), function () use ($team) {
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
                        'profile_photo_path' => $user->profile_photo_path,
                        'disabled' => false,
                    ];
                })
                ->toArray();
        });
    }
}

/**
 * Get the users assigned to a project.
 */
if (!function_exists('projectUsers')) {
    function projectUsers(\App\Models\Project $project)
    {
        return $project->users()->select('users.id', 'users.name', 'users.profile_photo_path')
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
    }
}
