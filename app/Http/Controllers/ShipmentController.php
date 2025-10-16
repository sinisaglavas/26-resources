<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewShipmentRequest;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unassigned = Cache::remember('unassigned_shipments', 600,
           fn() => Shipment::where(['status' => Shipment::STATUS_UNASSIGNED])->get());

        return view('shipments.index', [
            'shipments' => $unassigned,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * GET: /shipments/create
     */
    public function create()
    {
        $users = User::all();
        return view('shipments.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * POST: /shipments/create
     */
    public function store(NewShipmentRequest $request)
    {
        Shipment::create($request->validated());
        return redirect()->route('shipments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        return view('shipments.show', compact('shipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //
    }
}
