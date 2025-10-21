@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Create New Shipment</h2>

        <form action="{{ route('shipments.store') }}" enctype="multipart/form-data" method="POST" class="shadow p-4 rounded bg-light">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="from_city" class="form-label">From City</label>
                    <input type="text" name="from_city" id="from_city" class="form-control" value="{{ old('from_city') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="from_country" class="form-label">From Country</label>
                    <input type="text" name="from_country" id="from_country" class="form-control" value="{{ old('from_country') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="to_city" class="form-label">To City</label>
                    <input type="text" name="to_city" id="to_city" class="form-control" value="{{ old('to_city') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="to_country" class="form-label">To Country</label>
                    <input type="text" name="to_country" id="to_country" class="form-control" value="{{ old('to_country') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="documents" class="form-label">Choose a Picture</label>
                <input type="file" name="documents[]" id="documents" class="form-control" multiple required> {{-- documents[] pravi niz --}}
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="">-- Select Status --</option>
                    @foreach(\App\Models\Shipment::ALLOWED_STATUS as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                    <option value="bla">bla</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">-- Select User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="details" class="form-label">Details</label>
                <textarea name="details" id="details" class="form-control" rows="4" maxlength="1000">{{ old('details') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Create Shipment</button>
        </form>
    </div>
@endsection
