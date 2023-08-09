<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/')
    ->uses([\App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');


Route::post('/')
    ->uses([\App\Http\Controllers\HomeController::class, 'store'])
    ->name('home.store');


Route::get('/{code}')
    ->uses([\App\Http\Controllers\HomeController::class, 'redirect'])
    ->name('home.short')
    ->where('code', '[A-Za-z0-9]{8}');

Route::get('/{code}/stats')
    ->uses([\App\Http\Controllers\HomeController::class, 'stats'])
    ->name('home.stats')
    ->where('code', '[A-Za-z0-9]{8}');
