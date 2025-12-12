<?php

namespace App\Livewire;

use Livewire\Component;

class ShipmentsAssignedList extends Component
{
    public int $count = 0;
    public int $amount = 1;

    public function render()
    {
        return view('livewire.shipments-assigned-list');
    }

    public function increment()
    {
        $this->count += $this->amount;
    }

    public function decrement()
    {
        if ($this->count > 0) {
            $this->count -= $this->amount;
        }
    }
}
