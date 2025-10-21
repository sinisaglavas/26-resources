<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentDocument;
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
        $shipment = Shipment::create($request->validated());

        $fileTypes = [
            'application/pdf', // pdf
            'application/msword', // doc
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // docx
        ];

        foreach ($request->file('documents') as $document)
        {
            if (str_starts_with($document->getMimeType(), 'image/')) {
                $extension = $document->getClientOriginalExtension();
                $fileName = uniqid().'.'.$extension;
                $path = $document->storeAs("documents/$shipment->id", $fileName, 'public'); // storage/app/public

                dd($path);
            } elseif(in_array($document->getMimeType(), $fileTypes)) {
                $extension = $document->getClientOriginalExtension();
                $fileName = uniqid().'.'.$extension;
                $path = $document->storeAs("documents/$shipment->id", $fileName, 'public'); // storage/app/public

                $path = str_replace('documents/', '', $path); // sklanjamo prefiks 'documents/' da se ne upisuje u bazu

                ShipmentDocument::create([
                    'shipment_id' => $shipment->id,
                    'document_name' => $path,
                ]);
            }
        }
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
