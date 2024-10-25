<?php

namespace App\Policies;

use App\Models\ItemTemplate;
use App\Models\User;

class ItemTemplatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ItemTemplate $itemTemplate): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'file-template:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ItemTemplate $itemTemplate): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'file-template:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ItemTemplate $itemTemplate): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'file-template:delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ItemTemplate $itemTemplate): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ItemTemplate $itemTemplate): bool
    {
        //
    }
}
