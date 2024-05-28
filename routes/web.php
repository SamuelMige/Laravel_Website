<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\pageController;

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
//content
Route::get('/show/{id}', [HobbyController::class, 'show'])->name('hobbies.show');
Route::post('/content', [HobbyController::class, 'store'])->name('hobbies.store');
Route::put('/content/{id}', [HobbyController::class, 'update'])->name('hobbies.update');
Route::delete('/content/{id}', [HobbyController::class, 'destroy'])->name('hobbies.delete');
//page
Route::get('/', [pageController::class, 'index'])->name('items.index');
Route::get('/editPage', [pageController::class, 'edit'])->name('items.edit');
Route::put('/editPage/update', [pageController::class, 'update'])->name('items.update');

Auth::routes();

Route::get('/admin', [HobbyController::class, 'main'])->name('hobbies.index')->middleware('auth');
