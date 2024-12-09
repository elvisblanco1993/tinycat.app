<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientExport implements FromCollection, WithHeadings
{
    public $clients;

    public function __construct($clients)
    {
        $this->clients = $clients;
    }

    public function headings(): array
    {
        return [
            'ID',
            'name',
            'dba',
            'business_type',
            'phone',
            'email',
            'itin',
            'address',
            'address_ext',
            'city',
            'state',
            'zip',
            'country',
            'owner_name',
            'owner_email',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->clients->map(function ($client) {
            return [
                $client->id,
                $client->name,
                $client->dba,
                $client->business_type,
                $client->phone,
                $client->email,
                $client->itin,
                $client->address,
                $client->address_ext,
                $client->city,
                $client->state,
                $client->zip,
                $client->country,
                $client->owner->name,
                $client->owner->email,
            ];
        });
    }
}
