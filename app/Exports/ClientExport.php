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
            'Company Name',
            'DBA',
            'Business Type',
            'Phone',
            'Email',
            'ITIN',
            'Postal Address',
            'Address Line 2',
            'City',
            'State',
            'Zip code',
            'Country',
            'Date Created',
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
                $client->ITIN,
                $client->address,
                $client->address_ext,
                $client->city,
                $client->state,
                $client->zip,
                $client->country,
                $client->created_at->format('Y-m-d'),
            ];
        });
    }
}
