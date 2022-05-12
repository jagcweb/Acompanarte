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

Auth::routes(['verify' => true]);

Route::get('/registrar-{rol}', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register.index');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mi-perfil', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::post('/mi-perfil/actualizar', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/mi-perfil/actualizar-contraseña', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.update_password');
Route::get('/mi-perfil/get-image/{image}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.get_image');

Route::get('/configuracion', [App\Http\Controllers\ConfigurationController::class, 'index'])->name('configuration.index');

Route::get('/configuracion-profesor', [App\Http\Controllers\ConfigurationProfessorController::class, 'index'])->name('configuration_professor.index');
Route::post('/configuracion-profesor/guardar', [App\Http\Controllers\ConfigurationProfessorController::class, 'save'])->name('configuration_professor.save');
Route::post('/configuracion-profesor/actualizar', [App\Http\Controllers\ConfigurationProfessorController::class, 'update'])->name('configuration_professor.update');
Route::get('/configuracion-profesor/get-province/{community}', [App\Http\Controllers\ConfigurationProfessorController::class, 'getProvinces'])->name('configuration.get_province');
Route::get('/configuracion-profesor/get-city/{province}', [App\Http\Controllers\ConfigurationProfessorController::class, 'getCity'])->name('configuration.get_city');

Route::get('/configuracion-premium', [App\Http\Controllers\ConfigurationPremiumController::class, 'index'])->name('configuration_premium.index');
Route::get('/configuracion-premium/cambiar-renovacion', [App\Http\Controllers\ConfigurationPremiumController::class, 'changeAutoRenew'])->name('configuration_premium.auto_renew');
Route::get('/configuracion-premium/payment/{param}', [App\Http\Controllers\ConfigurationPremiumController::class, 'payment'])->name('configuration_premium.payment');
Route::get('/configuracion-premium/payment2/{param}', [App\Http\Controllers\ConfigurationPremiumController::class, 'payment2'])->name('configuration_premium.payment2');
Route::get('/configuracion-premium/premium/{param}/{auto_renew?}', [App\Http\Controllers\ConfigurationPremiumController::class, 'premium'])->name('configuration_premium.premium');
Route::get('/configuracion-premium/free', [App\Http\Controllers\ConfigurationPremiumController::class, 'free'])->name('configuration_premium.free');
Route::get('/configuracion-premium/get-invoice/{pdf}', [App\Http\Controllers\ConfigurationPremiumController::class, 'getInvoice'])->name('configuration_premium.get_invoice');

Route::post('/buscar-profesor', [App\Http\Controllers\SearchProfessorController::class, 'index'])->name('search_professor.index');
Route::get('/buscar-profesor/autocomplete-location/{value}', [App\Http\Controllers\SearchProfessorController::class, 'getLocation'])->name('search_professor.get_location');

Route::get('/ver-solicitudes', [App\Http\Controllers\ContactRequestController::class, 'index'])->name('contact_request.index');
Route::get('/ver-solicitud/{id}', [App\Http\Controllers\ContactRequestController::class, 'detail'])->name('contact_request.detail');
Route::post('/enviar-solicitud', [App\Http\Controllers\ContactRequestController::class, 'save'])->name('contact_request.save');
Route::get('/actualizar-solicitud/{param}', [App\Http\Controllers\ContactRequestController::class, 'update'])->name('contact_request.update');


//TEST
Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test.index');



//ADMIN
Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
Route::get('/dashboard/usuarios', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('dashboard.user');
Route::get('/dashboard/historial', [App\Http\Controllers\Admin\AdminController::class, 'history'])->name('dashboard.history');