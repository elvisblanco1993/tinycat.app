<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Attributes\Url;
use Livewire\Component;

class Update extends Component
{
    public Client $client;

    #[Url]
    public $navigate = 'business-details';

    public $name;

    public $dba;

    public $business_type;

    public $phone;

    public $email;

    public $itin;

    public $address;

    public $address_ext;

    public $city;

    public $state;

    public $zip;

    public $country;

    public function mount()
    {
        $this->authorize('update', $this->client);
        $this->fill($this->client->only([
            'name', 'dba', 'business_type', 'phone', 'email', 'itin',
            'address', 'address_ext', 'city', 'state', 'zip', 'country',
        ]));
    }

    public function render()
    {
        return view('livewire.client.update');
    }

    public function save()
    {
        $this->client->update([
            'name' => $this->name,
            'dba' => $this->dba,
            'business_type' => $this->business_type,
            'phone' => $this->phone,
            'email' => $this->email,
            'itin' => $this->itin,
            'address' => $this->address,
            'address_ext' => $this->address_ext,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'country' => $this->country,
        ]);
        $this->dispatch('saved');
    }
}
