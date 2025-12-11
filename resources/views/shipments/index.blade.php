@extends('layout')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Shipments</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($shipments as $shipment)
                <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $shipment->title }}</h4>
                    <p class="text-gray-600 font-medium">${{ number_format($shipment->price, 2) }}</p>
                    <p class="text-gray-600 font-medium">Driver: {{ $shipment->user->name ?? ''}}</p>
                    <a href="{{ route('shipments.show', ['shipment' => $shipment->id]) }}">View shipment</a>
                    <form method="POST" action="{{ route('shipments.assignUser', ['shipment' => $shipment->id]) }}" class="w-50">
                        @csrf
                        <input type="hidden" name="shipment_id" value="{{ $shipment->id }}">
                        <select name="user" class="form-control mt-2">
                            <option selected disabled>None</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit">Assigned</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection

