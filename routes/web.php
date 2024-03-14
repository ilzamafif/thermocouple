<?php

use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [SensorController::class, 'index'])->name('sensors');
Route::get('/sensors', [SensorController::class, 'index'])->name('sensors');
Route::post('/sensors', [SensorController::class, 'store'])->name('sensors.store');

Route::get('/clear-cache', function () {
   Artisan::call('cache:clear');
   Artisan::call('route:clear');

   return "Cache cleared successfully";
});