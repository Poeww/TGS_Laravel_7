<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;

Route::get('/', fn() => view('welcome'));

Route::get('/view/packages', [PackageController::class, 'view']);
Route::get('/view/packages/create', [PackageController::class, 'create']);
Route::post('/view/packages/store', [PackageController::class, 'storeFromView']);
Route::get('/view/packages/edit/{id}', [PackageController::class, 'edit']);
Route::post('/view/packages/update/{id}', [PackageController::class, 'updateFromView']);
Route::delete('/view/packages/delete/{id}', [PackageController::class, 'destroyFromView']);

Route::get('/view/bookings', [BookingController::class, 'view']);
Route::get('/view/bookings/create', [BookingController::class, 'create']);
Route::post('/view/bookings/store', [BookingController::class, 'storeFromView']);
Route::get('/view/bookings/edit/{id}', [BookingController::class, 'edit']);
Route::post('/view/bookings/update/{id}', [BookingController::class, 'updateFromView']);
Route::delete('/view/bookings/delete/{id}', [BookingController::class, 'destroyFromView']);