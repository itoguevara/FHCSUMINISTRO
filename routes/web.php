<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
use AppHttpContrllersAuthRegisterController;
use IlluminateSupportFacadesRoute;
*/
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
/*use App\Http\Controllers\PruebasController;*/
use App\Models\User;



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

Route::get('/', function () {
   /* return redirect('login');*/
    return redirect('home');
});

Route::get('/user', [HomeController::class, 'index'])->name('user.index')->middleware('auth');
Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('guest');
Route::view('login', 'auth.login')->name('login')->middleware('guest');
/*
Route::get('login', [HomeController::class, 'home'])->name('home')->middleware('auth');
Route::view('home', [HomeController::class, 'home'])->name('home')->middleware('auth');
Route::get('/pruebas', [PruebasController::class, 'index'])->name('pruebas.index')->middleware('auth');*/


Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);
