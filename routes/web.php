<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('no_autorizado', function () {
    return view('no_autorizado');
})->name('no_autorizado');

//ruta login
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('usuarios', App\Http\Controllers\UserController::class);
    Route::resource('roles', App\Http\Controllers\RolController::class);
    Route::post('bitacoras', [App\Http\Controllers\BitacoraController::class, 'index'])->name('bitacoras.index');
    Route::get('bitacoras', [App\Http\Controllers\BitacoraController::class, 'index'])->name('bitacoras.index');
});
