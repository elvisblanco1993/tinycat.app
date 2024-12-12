<?php

namespace App\Policies;

use App\Models\EmailBroadcast;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmailBroadcastPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EmailBroadcast $emailBroadcast): bool
    {
        return ! $user->is_client && $user->hasTeamPermission($user->currentTeam, 'email-broadcast:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return ! $user->is_client && $user->hasTeamPermission($user->currentTeam, 'email-broadcast:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EmailBroadcast $emailBroadcast): bool
    {
        return ! $user->is_client && $user->hasTeamPermission($user->currentTeam, 'email-broadcast:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EmailBroadcast $emailBroadcast): bool
    {
        return ! $user->is_client && $user->hasTeamPermission($user->currentTeam, 'email-broadcast:delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EmailBroadcast $emailBroadcast): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EmailBroadcast $emailBroadcast): bool
    {
        return false;
    }
}
