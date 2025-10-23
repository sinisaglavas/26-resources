<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentDocument;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class ShipmentController extends Controller
{
    use ImageUploadTrait;

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
        Gate::authorize('view', Shipment::class); // proverava da li korisnik (admin) ima pravo da vidi kreiranje shipment-a

        $users = User::all();
        return view('shipments.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * POST: /shipments/create
     */
    public function store(NewShipmentRequest $request)
    {
        Gate::authorize('create', Shipment::class); // proverava da li korisnik (admin) ima pravo da kreira shipment

        $shipment = Shipment::create($request->validated());

        $fileTypes = [
            'application/pdf', // pdf
            'application/msword', // doc
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // docx
        ];

        foreach ($request->file('documents') as $document)
        {
            if (str_starts_with($document->getMimeType(), 'image/')) {

                $name = $this->uploadImage($document, "documents/$shipment->id");
                $documentName = $shipment->id.'/'.$name;

                ShipmentDocument::create([
                    'shipment_id' => $shipment->id,
                    'document_name' => $documentName,
                ]);
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
        return view('shipments.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment)
    {
        $shipment->update($request->validated());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //
    }
}
