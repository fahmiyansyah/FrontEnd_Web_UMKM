<?php

use App\Http\Controllers\authController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\halamanController;
use App\Http\Controllers\sessionController;

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
Route::get('/auth',[authController::class,'index'])->name('login')->middleware('guest');;
Route::get('/auth/redirect',[authController::class,'redirect'])->middleware('guest');
Route::get('/auth/callback',[authController::class,'callback'])->middleware('guest');
Route::get('/auth/logout',[authController::class,'logout']);
Route::redirect('home', 'dasboard');

Route::prefix('dasboard')->middleware('auth')->group(
    function(){
        Route::get('/', function () {
            return view('dasboard.dasboard');
        });
        Route::resource('/halaman',halamanController::class);
        
    }
);
