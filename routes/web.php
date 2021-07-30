<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user-rigister/{id}',[App\Http\Controllers\HomeController::class, 'rigister'])->name('user.register');
Route::post('/create-password',[App\Http\Controllers\homeController::class,'creae_pass'])->name('crete.password');
Route::get('/verify-pin/{id}',[App\Http\Controllers\HomeController::class,'verify_pin'])->name('user.pin.verify');
Route::post('/verify-pin-code',[App\Http\Controllers\HomeController::class,'pin_verified'])->name('verify-pin-code');

