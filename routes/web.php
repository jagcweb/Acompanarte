<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/registrar-{rol}', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register.index');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mi-perfil', [App\Http\Controllers\UserProfileController::class, 'index'])->name('userprofile.index');
Route::post('/mi-perfil-actualizar', [App\Http\Controllers\UserProfileController::class, 'update'])->name('userprofile.update');

Route::get('/configuracion', [App\Http\Controllers\ConfigurationController::class, 'index'])->name('configuration.index');

Route::get('/configuracion-profesor', [App\Http\Controllers\ConfigurationProfessorController::class, 'index'])->name('configuration_professor.index');

Route::get('/configuracion-premium', [App\Http\Controllers\ConfigurationPremiumController::class, 'index'])->name('configuration_premium.index');

Route::post('/buscar-profesor', [App\Http\Controllers\SearchProfessorController::class, 'index'])->name('search_professor.index');
