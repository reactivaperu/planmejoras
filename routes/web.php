<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanMejoraController;
use App\Http\Controllers\AccionMejoraController;
use App\Http\Controllers\ActividadAccionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\Auth\GoogleController;

/* ROUTE PRINCIPAL LOGIN  */
Route::get('/', function () { return view('auth.login'); })->middleware('guest'); // MIDDLEWARE WITHOUT AUTHENTICATION

/* CONFIG AUTHETICATION  */
Auth::routes(['register'=>false,'reset'=>false]);

/* ROUTES PRINCIPAL LOGGED & AUTHENTICATE  */
Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/* ROUTES APP  */
Route::resource('usuarios', UsuarioController::class)->middleware('auth'); // MIDDLEWARE AUTHICATION RUN
Route::resource('planes', PlanMejoraController::class)->middleware('auth'); // MIDDLEWARE AUTHICATION RUN
Route::get('acciones/create/{idPlan}',[AccionMejoraController::class, 'create'])->middleware('auth'); // MIDDLEWARE AUTHICATION RUN
Route::resource('acciones', AccionMejoraController::class, ['except' => 'create'])->middleware('auth'); // MIDDLEWARE AUTHICATION RUN

Route::resource('actividades', ActividadAccionController::class)->middleware('auth'); // MIDDLEWARE AUTHICATION RUN

/* ROUTES PARA EL LOGIN CON GOOGLE  */
Route::get('auth/google',[GoogleController::class,'redirectToGoogle']);
Route::get('auth/google/callback',[GoogleController::class,'handleGoogleCallback']);
//Auth::routes(['register'=>false,'reset'=>false]); (ONLY LOGIN WITH GOOGLE ACCOUNS)

/* ROUTES ROL (obsolete)  */
Route::resource('roles', RolController::class)->middleware('auth'); // MIDDLEWARE AUTHICATION RUN