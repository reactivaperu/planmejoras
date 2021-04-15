<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\GoogleController;

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

Route::get('/', function () { return view('auth.login'); });

//Route::get('/rol', function () { return view('rol.index'); });
//Route::get('/rol/create',[RolController::class,'create']);
Route::resource('rol', RolController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [RolController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', [RolController::class, 'index'])->name('home');
});

Route::get('auth/google/redirect',[GoogleController::class,'redirect']);
Route::get('auth/google/callback',[GoogleController::class,'callback']);