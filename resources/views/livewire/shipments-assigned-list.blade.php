<div>
    <p>Iznos: <span class="{{ $count >= 5000 ? 'red' : '' }}">{{ $count }}</span> </p>
    <button class="btn border" wire:click="increment">Povecaj</button>
    <button class="btn border" wire:click="decrement">Smanji</button>

    <input class="border" type="number" min="1"
            wire:model.live.debounce="amount">
    <p>Kolicina: {{ $amount }}</p>
    <p>{{ $error }}</p>

</div>
