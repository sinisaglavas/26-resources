<?php

namespace App\Livewire;

use App\Models\Shipment;
use App\Models\User;
use Livewire\Component;

class CreateShipment extends Component
{
    public string $title;
    public string $fromCity;
    public string $toCity;
    public string $fromCountry;
    public string $toCountry;
    public float $price;
    public array $statuses = [];
    public string $status = '';
    public int $clientId;
    public string $clientError;



    public function render()
    {
        return view('livewire.create-shipment');
    }

    public function mount() // poziva se kada se livewire komponenta ucita i onda ce samo jednom pozvati bazu
    {
        $this->statuses = Shipment::ALLOWED_STATUS;
    }

    public function validateUser()
    {
        $user = User::firstWhere('id', $this->clientId);

        $this->clientError = '';
        if (!$user) {
            $this->clientError = 'Ovaj korisnik ne postoji!';
        }
    }
}
