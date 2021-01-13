<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/management/users/all', [UserController::class, 'index'])->name('users.index');
Route::get('/management/users/search', [UserController::class, 'search'])->name('search');
Route::get('/management/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/management/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/management/users/confirm/{token}', [UserController::class, 'confirm_email'])->name('confirm_email');

