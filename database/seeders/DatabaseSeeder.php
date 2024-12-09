<?php

namespace Database\Seeders;

use App\Models\Client;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        $user = User::factory()->withPersonalTeam()->create([
            'name' => 'Elvis Blanco',
            'email' => 'eblanco@bytekit.co',
            'password' => Hash::make('password'),
        ]);

        $user->update(['current_team_id' => $user->ownedTeams()->first()->id]);

        // Client::factory()->count(1000)->create([
        //     'team_id' => $user->current_team_id,
        // ]);
    }
}
