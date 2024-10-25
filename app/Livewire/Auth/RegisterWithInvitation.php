<?php

namespace App\Livewire\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class RegisterWithInvitation extends Component
{
    use InteractsWithBanner;
    use PasswordValidationRules;

    public TeamInvitation $invitation;

    public $name;

    public $password;

    public $password_confirmation;

    public function mount()
    {
        if (! request()->hasValidSignature()) {
            abort(401);
        }
    }

    public function render()
    {
        return view('livewire.auth.register-with-invitation');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string',
            'password' => $this->passwordRules(),
        ]);

        DB::transaction(function () {
            User::create([
                'name' => $this->name,
                'email' => $this->invitation->email,
                'password' => Hash::make($this->password),
                'current_team_id' => $this->invitation->team_id,
            ]);

            app(AddsTeamMembers::class)->add(
                $this->invitation->team->owner,
                $this->invitation->team,
                $this->invitation->email,
                $this->invitation->role,
            );

            $this->invitation->delete();
        });

        $this->banner(__('Great! You have accepted the invitation to join the :team team.', ['team' => $this->invitation->team->name]));

        $this->redirect(config('fortify.home'));
    }
}
