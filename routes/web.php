<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObyekWisataController;
use Illuminate\Support\Facades\Auth;

// Route Publik
Route::resource('/', App\Http\Controllers\HomeController::class);

// Autentikasi
Route::middleware(['guest'])->group(function(){
    Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
    Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);
    
    Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
});

// Route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function(){
    // Dashboard berdasarkan role
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
        ->middleware('userAkses:admin')
        ->name('admin.dashboard');
        
    Route::get('/bendahara', [App\Http\Controllers\BendaharaController::class, 'index'])
        ->middleware('userAkses:bendahara')
        ->name('bendahara.dashboard');
        
    Route::get('/owner', [App\Http\Controllers\OwnerController::class, 'index'])
        ->middleware('userAkses:owner')
        ->name('owner.dashboard');
    
    // Logout
    Route::post('/logout', function() {
        Auth::logout();
        return redirect('/');
    })->name('logout');
    
    // Resource Routes
    Route::resource('/resetpassword', App\Http\Controllers\ResetPasswordController::class);
    Route::resource('/bendahara', App\Http\Controllers\BendaharaController::class);
    Route::resource('/owner', App\Http\Controllers\OwnerController::class);
    Route::resource('/penginapan', App\Http\Controllers\PenginapanController::class);
    Route::resource('/berita', App\Http\Controllers\BeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('/obyekwisata', App\Http\Controllers\ObyekWisataController::class)->parameters(['obyekwisata' => 'ObyekWisata']);
    Route::resource('/users', App\Http\Controllers\UsersController::class);
    Route::resource('/pelanggan', App\Http\Controllers\PelangganController::class);
    Route::resource('/paketwisata', App\Http\Controllers\PaketWisataController::class);
    Route::resource('/reservasi', App\Http\Controllers\ReservasiController::class)->except(['index']);
    Route::resource('/karyawan', App\Http\Controllers\KaryawanController::class);
    Route::resource('/kategoriberita', App\Http\Controllers\KategoriBeritaController::class);
    Route::resource('/kategoriwisata', App\Http\Controllers\KategoriWisataController::class);
    Route::resource('/diskon', App\Http\Controllers\DiskonController::class);
    Route::resource('/voucher', App\Http\Controllers\VoucherController::class);
    Route::resource('/konfirmasireservasi', App\Http\Controllers\KonfirmasiReservasiController::class);
    
    // Custom Routes untuk Reservasi
    Route::get('/reservasi/riwayat', [App\Http\Controllers\ReservasiController::class, 'riwayat'])->name('reservasi.riwayat');
    Route::get('/reservasi/{id}/invoice', [App\Http\Controllers\ReservasiController::class, 'invoice'])->name('reservasi.invoice');
    Route::get('/reservasi/{id}/download-invoice', [App\Http\Controllers\ReservasiController::class, 'downloadInvoice'])->name('reservasi.download-invoice');
    Route::post('/reservasi', [App\Http\Controllers\ReservasiController::class, 'store'])->name('reservasi.store');
    
    // Custom Routes untuk Diskon
    Route::post('/diskon/claim/{id}', [App\Http\Controllers\DiskonController::class, 'claim'])->name('diskon.claim');
    
    // Custom Routes untuk Konfirmasi Reservasi
    Route::post('/konfirmasireservasi/{id}/update-status', [App\Http\Controllers\KonfirmasiReservasiController::class, 'updateStatus'])
        ->name('konfirmasireservasi.updateStatus');
});

   


// Route Frontend
Route::get('/reservasi', [App\Http\Controllers\ReservasiController::class, 'index'])->name('fe.reservasi');
Route::get('/fe/riwayatreservasi/{id}', [App\Http\Controllers\ReservasiController::class, 'showRiwayat'])->name('fe.riwayatreservasi');
Route::get('/fe/invoice/{id}', [App\Http\Controllers\ReservasiController::class, 'downloadInvoicePublic'])->name('fe.invoice');

// Redirect untuk backend user
Route::middleware(['auth', 'backendUser'])->group(function() {
    Route::get('/admin/*', function () {
        return redirect()->route('admin.dashboard');
    });
    
    Route::get('/bendahara/*', function () {
        return redirect()->route('bendahara.dashboard');
    });
    
    Route::get('/owner/*', function () {
        return redirect()->route('owner.dashboard');
    });
});

// Home route
Route::get('/home', function () {
    return view('home.index', [
        'title' => 'Home'
    ]);
});