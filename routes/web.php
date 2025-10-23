<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// pravi rute koje su nama potrebne pod uslovom da imamo sve crud metode u kontroleru

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//GET|HEAD        shipments ... shipments.index › ShipmentController@index
//  POST            shipments ... shipments.store › ShipmentController@store
//  GET|HEAD        shipments/create ... shipments.create › ShipmentController@create
//  GET|HEAD        shipments/{shipment} ... shipments.show › ShipmentController@show
//  PUT|PATCH       shipments/{shipment} ... shipments.update › ShipmentController@update
//  DELETE          shipments/{shipment} ... shipments.destroy › ShipmentController@destroy
//  GET|HEAD        shipments/{shipment}/edit ... shipments.edit › ShipmentController@edit
//  GET|HEAD        storage/{path} ... storage.local
Route::resource('shipments', ShipmentController::class);

require __DIR__.'/auth.php';
