<?php

namespace App\Livewire;

use Livewire\Component;

class ShipmentsAssignedList extends Component
{
    public int $count = 0;
    public int $amount = 1;
    public string $error = '';

    public function render()
    {
        return view('livewire.shipments-assigned-list');
    }

    public function increment()
    {
        $this->count += $this->amount;
        $this->error = '';
    }

    public function decrement()
    {
        $result = $this->count - $this->amount;
        if ($result >= 0) {
            $this->count -= $this->amount;
        } else {
            $this->error = 'Broj ne moze biti negativan';
        }
    }
}
