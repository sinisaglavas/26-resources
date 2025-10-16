@extends('layout')

@section('content')
    @foreach($shipments as $shipment)
        <div>
            <h4>{{ $shipment->title }}</h4>
            <p>{{ $shipment->price }}</p>
        </div>
    @endforeach
@endsection
