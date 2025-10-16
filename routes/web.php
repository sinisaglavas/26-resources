<?php

use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('shipments.index');
//});

// pravi rute koje su nama potrebne pod uslovom da imamo sve crud metode u kontroleru
Route::resource('shipments', ShipmentController::class);
