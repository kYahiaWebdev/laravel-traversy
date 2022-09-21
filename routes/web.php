<?php

use App\Http\Controllers\listingController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing ;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [listingController::class, 'index']);

// Listings

Route::get('/listing/create', [listingController::class, 'create'])->middleware('auth');

Route::get('/listing/manage', [listingController::class, 'manage'])->middleware('auth');

Route::get('/listing/{id}', [listingController::class, 'show'])->whereNumber('id');

Route::get('/listing/{id}/edit', [listingController::class, 'edit'])->whereNumber('id')->middleware('auth');

Route::put('/listing/{id}', [listingController::class, 'update'])->whereNumber('id')->middleware('auth');

Route::delete('/listing/{id}', [listingController::class, 'destroy'])->whereNumber('id')->middleware('auth');

Route::post('/listing/create', [listingController::class, 'store'])->middleware('auth');

// User auth

Route::get('/register', [userController::class, 'create'])->middleware('guest');

Route::post('/user', [userController::class, 'store'])->middleware('guest');

Route::post('/logout', [userController::class, 'logout'])->middleware('auth');

Route::get('/login', [userController::class, 'login'])->name('login')->middleware('guest');

Route::post('/login', [userController::class, 'authenticate'])->middleware('guest');





