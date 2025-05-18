<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObyekWisataController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', App\Http\Controllers\HomeController::class);
// Route::resource('/home', App\Http\Controllers\HomeController::class);
// Route::resource('/register', App\Http\Controllers\RegisterController::class);

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);

Route::resource('/resetpassword', App\Http\Controllers\ResetPasswordController::class);
Route::resource('/bendahara', App\Http\Controllers\BendaharaController::class);
Route::resource('/owner', App\Http\Controllers\OwnerController::class);
Route::resource('/penginapan', App\Http\Controllers\PenginapanController::class);
Route::resource('/berita', App\Http\Controllers\BeritaController::class)->parameters(['berita' => 'berita']);
Route::resource('/obyekwisata', App\Http\Controllers\ObyekWisataController::class)->parameters(['obyekwisata' => 'ObyekWisata']);
Route::resource('/users', App\Http\Controllers\UsersController::class);
Route::resource('/pelanggan', App\Http\Controllers\PelangganController::class);
Route::resource('/paketwisata', App\Http\Controllers\PaketWisataController::class);
Route::resource('/reservasi', App\Http\Controllers\ReservasiController::class)->middleware('auth');
Route::resource('/karyawan', App\Http\Controllers\KaryawanController::class);
Route::resource('/kategoriberita', App\Http\Controllers\KategoriBeritaController::class);
Route::resource('/kategoriwisata', App\Http\Controllers\KategoriWisataController::class);

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
});

Route::get('/home', function () {
    return view('home.index', [
        'title' => 'Home'
    ]);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->middleware('userAkses:admin');
    Route::get('/bendahara', [App\Http\Controllers\BendaharaController::class, 'index'])->middleware('userAkses:bendahara');
    Route::get('/owner', [App\Http\Controllers\OwnerController::class, 'index'])->middleware('userAkses:owner');
    
    Route::post('/logout', function() {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

?>