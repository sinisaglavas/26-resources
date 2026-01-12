<div>
    <form action="">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input wire:model.live.debounce="title" type="text" id="title" class="form-control" required>
        </div>
        <p>{{ $title }}</p>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="from_city" class="form-label">From City</label>
                <input wire:model="fromCity" type="text" id="from_city" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="from_country" class="form-label">From Country</label>
                <input wire:model="fromCountry" type="text" id="from_country" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="to_city" class="form-label">To City</label>
                <input wire:model="toCity" type="text" id="to_city" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="to_country" class="form-label">To Country</label>
                <input wire:model="toCountry" type="text" id="to_country" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price ($)</label>
            <input wire:model="price" type="number" step="0.01" id="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select wire:model="status" id="status" class="form-select" required>
                <option value="">-- Select Status --</option>
                @foreach($statuses as $singleStatus)
                    <option value="{{ $singleStatus }}">{{ $singleStatus }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <p>{{ $clientError }}</p>
            <label for="client_id" class="form-label">Client</label>
            <input wire:model="clientId" wire:blur="validateUser" type="number" id="client_id" class="form-control" min="1" required>
        </div>
    </form>
</div>
