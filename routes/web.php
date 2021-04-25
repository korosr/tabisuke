<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuideController;


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

Route::get('/', [App\Http\Controllers\GuideController::class, 'index']);

Route::resource('/guides', GuideController::class, ['except' => ['update', 'destroy']]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/update/{guide}', [App\Http\Controllers\GuideController::class, 'updateGuide'])->name('guides.update');
Route::post('/delete/{guide}', [App\Http\Controllers\GuideController::class, 'deleteGuide'])->name('guides.delete');