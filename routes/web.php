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

Route::get('/mi-perfil', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::post('/mi-perfil/actualizar', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/mi-perfil/actualizar-contraseña', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.update_password');
Route::get('/mi-perfil/get-image/{image}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.get_image');

Route::get('/configuracion', [App\Http\Controllers\ConfigurationController::class, 'index'])->name('configuration.index');

Route::get('/configuracion-profesor', [App\Http\Controllers\ConfigurationProfessorController::class, 'index'])->name('configuration_professor.index');
Route::post('/configuracion-profesor/guardar', [App\Http\Controllers\ConfigurationProfessorController::class, 'save'])->name('configuration_professor.save');
Route::get('/configuracion-profesor/get-province/{community}', [App\Http\Controllers\ConfigurationProfessorController::class, 'getProvinces'])->name('configuration.get_province');
Route::get('/configuracion-profesor/get-city/{province}', [App\Http\Controllers\ConfigurationProfessorController::class, 'getCity'])->name('configuration.get_city');

Route::get('/configuracion-premium', [App\Http\Controllers\ConfigurationPremiumController::class, 'index'])->name('configuration_premium.index');
Route::get('/configuracion-premium/premium', [App\Http\Controllers\ConfigurationPremiumController::class, 'premium'])->name('configuration_premium.premium');
Route::get('/configuracion-premium/free', [App\Http\Controllers\ConfigurationPremiumController::class, 'free'])->name('configuration_premium.free');

Route::post('/buscar-profesor', [App\Http\Controllers\SearchProfessorController::class, 'index'])->name('search_professor.index');
