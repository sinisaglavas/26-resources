<?php

namespace App\Livewire;

use Livewire\Component;

class ShipmentsAssignedList extends Component
{
    public int $count = 0;

    public function render()
    {
        return view('livewire.shipments-assigned-list');
    }

    public function increment()
    {
        $this->count++;
    }
}
