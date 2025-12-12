<div>
    <p>Iznos: {{ $count }}</p>
    <button wire:click="increment">Povecaj</button>
    <button wire:click="decrement">Smanji</button>

    <input class="border" type="number" min="1"
            wire:model.live.debounce="amount">
    <p>Amount is: {{ $amount }}</p>
    <p>{{ $error }}</p>
</div>
