<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MidtransController;

Route::get('/cuaca', [BookingController::class, 'getCuaca']);
Route::post('/midtrans/callback', [MidtransController::class, 'handleCallback']);