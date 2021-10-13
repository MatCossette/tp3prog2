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

Route::get('/createMeal', [MealController::class, 'create'])
                ->middleware(['auth'])
                ->name('createMeal');

Route::post('/reserve/{foodCard}/{id}', [MealController::class, 'reserve'])
                ->middleware(['auth'])
                ->name('reserveMeal');


Route::post('/createMeal', [MealController::class, 'store'])         
                ->middleware(['auth'])
                ->name('createMeal');

Route::delete('/deleteMeal/{id}', [MealController::class, 'destroy'])
                ->name('deleteMeal');

Route::post('/erase/{id}', [MealController::class, 'erase'])
                ->middleware(['auth'])
                ->name('eraseMeal');


require __DIR__ . '/auth.php';
