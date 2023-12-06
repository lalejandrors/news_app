<?php

use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PreferenciaController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//login y registro
Route::view('/', 'welcome');
Route::view('/login', 'login')->name('login')->middleware('guest');
Route::post('/login', function(){
    $credentials = request()->only('email', 'password');

    if(Auth::attempt($credentials)){
        request()->session()->regenerate();
        return redirect('dashboard');
    }

    return redirect('login');
});
Route::post('/logout', function(){
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('login');
});

Route::get('/registro', [RegistroController::class, 'create'])->name('registro.create')->middleware('guest');
Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store')->middleware('guest');
//

//noticias
Route::get('/dashboard', [NoticiaController::class, 'index'])->name('noticias.index')->middleware('auth');
//

//preferencias
Route::get('/preferencias', [PreferenciaController::class, 'edit'])->name('preferencias.edit')->middleware('auth');
Route::put('/preferencias', [PreferenciaController::class, 'update'])->name('preferencias.update')->middleware('auth');
//

//favoritas
Route::get('/favoritas', [FavoritoController::class, 'index'])->name('favoritas.index')->middleware('auth');
Route::post('/addfavoritas/{id}', [FavoritoController::class, 'store'])->name('favoritas.store')->middleware('auth');
Route::delete('/delfavoritas/{id}', [FavoritoController::class, 'destroy'])->name('favoritas.destroy')->middleware('auth');
//
