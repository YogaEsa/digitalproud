<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GreetingController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/create', [GreetingController::class, 'store'])->name('greeting.store');
Route::get('/card/{slug}', [GreetingController::class, 'show'])->name('greeting.show');

Route::get('/expired', function () {
    return view('expired');
})->name('expired');
