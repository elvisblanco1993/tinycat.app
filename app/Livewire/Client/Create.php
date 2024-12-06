<?php

namespace App\Livewire\Client;

use App\Mail\ClientOwnerAccountCreated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $modal;

    public $name;

    public $business_type;

    public $owner_name;

    public $owner_email;

    public function render()
    {
        return view('livewire.client.create', [
            'itemTemplates' => Auth::user()->currentTeam->itemTemplates,
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string'],
            'business_type' => ['required'],
            'owner_name' => ['required', 'string'],
            'owner_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);

        $password = Str::random(12);

        DB::transaction(function () use ($password) {
            $owner = User::create([
                'name' => $this->owner_name,
                'email' => $this->owner_email,
                'password' => Hash::make($password),
                'is_client' => true,
            ]);

            $client = Auth::user()->currentTeam->clients()->create([
                'name' => $this->name,
                'business_type' => $this->business_type,
                'owner_id' => $owner->id,
                'email' => $owner->email,
            ]);

            // Send Mail to Client Account Owner
            Mail::to($owner->email)->queue(new ClientOwnerAccountCreated(
                $client->team->name,
                $this->owner_name,
                $password,
            ));
            $this->reset();
            $this->banner('Client added!');
            $this->dispatch('client-added');
        });
    }
}
