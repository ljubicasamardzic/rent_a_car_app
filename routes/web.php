<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HomeController;

Route::middleware(['auth'])->group(function () {
     Route::get('/', [ReservationController::class, 'index']);
     Route::get('/home', [HomeController::class, 'index'])->name('home');

     // vehicle create
     Route::get('/vehicles/create-one', [VehicleController::class, 'createStepOne']);
     Route::post('/vehicles/post-one', [VehicleController::class, 'postStepOne']);
     Route::get('/vehicles/create-two', [VehicleController::class, 'createStepTwo'])->name('vehicles.create.two');
     Route::post('/vehicles/post-two', [VehicleController::class, 'postStepTwo']);

     // vehicle edit 
     Route::get('/vehicles/{id}/edit-one', [VehicleController::class, 'editStepOne']);
     Route::post('/vehicles/{id}/post-edit-one', [VehicleController::class, 'postEditStepOne']);
     Route::get('/vehicles/edit-two', [VehicleController::class, 'editStepTwo'])->name('vehicles.edit.two');;
     Route::put('/vehicles/{id}/post-edit-two', [VehicleController::class, 'postEditStepTwo']);

     Route::get('/availability', [VehicleController::class, 'availability']);
     Route::post('/availability', [VehicleController::class, 'checkAvailability']);

     // resources
     Route::resource('/vehicles', VehicleController::class);
     Route::resource('/clients', ClientController::class);
     Route::resource('/reservations', ReservationController::class);


});     
Auth::routes();