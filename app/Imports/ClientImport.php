<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientOwnerAccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading
{
    public $team_id;

    public function __construct($team_id)
    {
        $this->team_id = $team_id;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'itin';
    }

    public function model(array $row)
    {

        // Skip record if no owner name or email exists
        if (!isset($row['owner_name']) || !isset($row['owner_email']) || !$this->team_id) {
            return null;
        }

        $user = User::create([
            'name' => $row['owner_name'],
            'email' => $row['owner_email'],
            'password' => null,
            'is_client' => true,
        ]);

        $client = new Client([
            'team_id' => $this->team_id,
            'owner_id' => $user->id,
            'name' => $row['name'],
            'dba' => $row['dba'],
            'business_type' => $row['business_type'],
            'phone' => $row['phone'] ?? null,
            'email' => $row['email'] ?? null,
            'itin' => $row['itin'],
            'address' => $row['address'] ?? null,
            'address_ext' => $row['address_ext'] ?? null,
            'city' => $row['city'] ?? null,
            'state' => $row['state'] ?? null,
            'zip' => $row['zip'] ?? null,
            'country' => $row['country'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Mail::to($user->email)->queue(new ClientOwnerAccountCreated(
            $client->team->name,
            $row['owner_name'],
        ));

        return $client;
    }
}
