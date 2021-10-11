<?php

use App\Http\Controllers\MealController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;



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

Route::get('/', [MealController::class, 'index'])->name('/');

Route::get('/createMeal', [MealController::class, 'create'])->middleware(['auth'])->name('createMeal');

Route::post('/createMeal', [MealController::class, 'store'])->middleware(['auth'])->name('createMeal');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
