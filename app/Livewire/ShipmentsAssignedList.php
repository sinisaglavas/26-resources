<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class ShipmentsAssignedList extends Component
{
    public int $count = 0;
    public int $amount = 1;
    public string $error = '';

    public function render(): View
    {
        return view('livewire.shipments-assigned-list');
    }

    public function increment(): void
    {
        $this->count += $this->amount;
        $this->error = '';
    }

    public function decrement(): void
    {
        $result = $this->count - $this->amount;
        if ($result >= 0) {
            $this->count -= $this->amount;
        } else {
            $this->error = 'Broj ne moze biti negativan';
        }
    }

    public function validateAmount(): void
    {
        $this->amount < 1 ? $this->error = 'Broj ne moze biti manji od 1' : $this->error = '';

    }
}
