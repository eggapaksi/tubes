<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Session\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('katalog', KatalogController::class);
Route::resource('beranda', BerandaController::class);


Route::get('/login', [SessionController::class,'index'])
    ->name('login');
Route::post('/login', [SessionController::class,'loginProses'])
    ->name('loginProses');
Route::post('/logout', [SessionController::class,'logout'])
    ->name('logout');
    
Route::post('booking', [BookingController::class, 'store'])
    ->name('booking.store');
Route::post('/booking/confirm', [BookingController::class, 'confirm'])
    ->name('booking.confirm');
Route::post('/booking/confirm/pembayaran', [BookingController::class, 'pembayaran'])
    ->name('booking.pembayaran');

Route::get('/booking/list', [BookingController::class, 'list'])
    ->name('booking.list');
Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])
    ->name('booking.edit');
Route::put('/booking/{id}', [BookingController::class, 'update'])
    ->name('booking.update');
Route::delete('/booking/{id}', [BookingController::class, 'destroy'])
    ->name('booking.destroy');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register-proses', [RegisterController::class, 'registerProses'])->name('register.proses');


Route::middleware('auth')->group(function () {

    // READ PROFIL
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');

    // UPDATE PROFIL
    Route::post('/profil/update', [ProfileController::class, 'update'])->name('profil.update');

    // DELETE AKUN
    Route::post('/profil/delete', [ProfileController::class, 'destroy'])->name('profil.delete');

});
// READ - Tampilkan semua ulasan
Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');

// CREATE - Simpan ulasan baru
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store')->middleware('auth');

// UPDATE - Update ulasan
Route::put('/ulasan/{id}', [UlasanController::class, 'update'])->name('ulasan.update');

// DELETE - Hapus ulasan  
Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');

/*Route::post('/booking/store', [BookingController::class, 'store'])
    ->name('booking.store');*/
       