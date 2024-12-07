<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Account Owner', [
            'client:create',
            'client:view',
            'client:update',
            'client:delete',
            'form:create',
            'form:view',
            'form:update',
            'form:delete',
            'file-template:create',
            'file-template:view',
            'file-template:update',
            'file-template:delete',
            'upload-request:create',
            'upload-request:view',
            'upload-request:update',
            'upload-request:delete',
            'project:create',
            'project:view',
            'project:update',
            'project:delete',
        ])->description('Account administrators have full access and can perform all actions, including managing the organization and billing settings.');

        Jetstream::role('manager', 'Manager', [
            'client:create',
            'client:view',
            'client:update',
            'client:delete',
            'form:create',
            'form:view',
            'form:update',
            'form:delete',
            'file-template:create',
            'file-template:view',
            'file-template:update',
            'file-template:delete',
            'upload-request:create',
            'upload-request:view',
            'upload-request:update',
            'upload-request:delete',
            'project:create',
            'project:view',
            'project:update',
            'project:delete',
        ])->description('Managers can perform all employee-related actions, add employees, and oversee employee activities.');

        Jetstream::role('employee', 'Employee', [
            'client:view',
            'client:create',
            'client:update',
        ])->description('Employees can engage with clients, manage tasks, and handle messages from clients.');
    }
}
