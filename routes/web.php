<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportController;
use App\Models\Airline;
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
// */

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AirportController::class, 'index'])->name('index');

Route::get('/edit/{id}', [AirportController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [AirportController::class, 'update'])->name('update');
Route::get('/create', [AirportController::class, 'create'])->name('create');
Route::post('/store', [AirportController::class, 'store'])->name('store');
Route::post('/delete/{id}', [AirportController::class, 'destroy'])->name('delete');


Route::get('/airlines', [AirlineController::class, 'index'])->name('airlines.index');
Route::get('/airlinecreate', [AirlineController::class, 'create'])->name('airline.create');
Route::get('/editairline/{id}', [AirlineController::class, 'edit'])->name('edit.airline');
Route::post('/airlinestore', [AirlineController::class, 'store'])->name('airline.store');
Route::post('/airlineupdate/{id}', [AirlineController::class, 'update'])->name('airline.update');
Route::post('/airlinedelete/{id}', [AirlineController::class, 'destroy'])->name('airline.delete');
