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

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/registrar-{rol}', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register.index');
Route::post('/registrar', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register.create');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mi-perfil', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/usuario/{username}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
Route::post('/mi-perfil/actualizar', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/mi-perfil/actualizar-contraseña', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.update_password');
Route::get('mi-perfil/get-image/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.get_image');

Route::get('/configuracion', [App\Http\Controllers\ConfigurationController::class, 'index'])->name('configuration.index');

Route::get('/configuracion-pianista', [App\Http\Controllers\ConfigurationProfessorController::class, 'index'])->name('configuration_professor.index');
Route::post('/configuracion-pianista/guardar', [App\Http\Controllers\ConfigurationProfessorController::class, 'save'])->name('configuration_professor.save');
Route::post('/configuracion-pianista/actualizar', [App\Http\Controllers\ConfigurationProfessorController::class, 'update'])->name('configuration_professor.update');
Route::get('/configuracion-pianista/get-province/{community}', [App\Http\Controllers\ConfigurationProfessorController::class, 'getProvinces'])->name('configuration.get_province');
Route::get('/configuracion-pianista/get-city/{province}', [App\Http\Controllers\ConfigurationProfessorController::class, 'getCity'])->name('configuration.get_city');

Route::get('/configuracion-premium', [App\Http\Controllers\ConfigurationPremiumController::class, 'index'])->name('configuration_premium.index');
Route::get('/configuracion-premium/cambiar-renovacion', [App\Http\Controllers\ConfigurationPremiumController::class, 'changeAutoRenew'])->name('configuration_premium.auto_renew');
Route::get('/configuracion-premium/payment/{param}', [App\Http\Controllers\ConfigurationPremiumController::class, 'payment'])->name('configuration_premium.payment');
Route::get('/configuracion-premium/payment2/{param}', [App\Http\Controllers\ConfigurationPremiumController::class, 'payment2'])->name('configuration_premium.payment2');
Route::get('/configuracion-premium/premium/{type}/{auto_renew?}', [App\Http\Controllers\ConfigurationPremiumController::class, 'premium'])->name('configuration_premium.premium');
Route::get('/configuracion-premium/free', [App\Http\Controllers\ConfigurationPremiumController::class, 'free'])->name('configuration_premium.free');
Route::get('/configuracion-premium/get-invoice/{pdf}', [App\Http\Controllers\ConfigurationPremiumController::class, 'getInvoice'])->name('configuration_premium.get_invoice');

Route::get('/buscar-pianista', [App\Http\Controllers\SearchProfessorController::class, 'index'])->name('search_professor.index');
Route::get('/buscar-pianista/autocomplete-location/{value}', [App\Http\Controllers\SearchProfessorController::class, 'getLocation'])->name('search_professor.get_location');

Route::get('/ver-solicitudes', [App\Http\Controllers\ContactRequestController::class, 'index'])->name('contact_request.index');
Route::get('/ver-solicitud/{id}', [App\Http\Controllers\ContactRequestController::class, 'detail'])->name('contact_request.detail');
Route::post('/enviar-solicitud', [App\Http\Controllers\ContactRequestController::class, 'save'])->name('contact_request.save');
Route::get('/actualizar-solicitud/{type}', [App\Http\Controllers\ContactRequestController::class, 'update'])->name('contact_request.update');
Route::get('/aceptar-solicitud/{id}', [App\Http\Controllers\ContactRequestController::class, 'accept'])->name('contact_request.accept');
Route::get('/rechazar-solicitud/{id}', [App\Http\Controllers\ContactRequestController::class, 'decline'])->name('contact_request.decline');
Route::get('/solicitudes/get-pdf/{pdf}', [App\Http\Controllers\ContactRequestController::class, 'getPdf'])->name('contact_request.get_pdf');


Route::get('/borrar-notificacion/{id}', [App\Http\Controllers\NotificationController::class, 'delete'])->name('notification.delete');
Route::get('/borrar-notificaciones', [App\Http\Controllers\NotificationController::class, 'deleteAll'])->name('notification.deleteAll');
Route::get('/ver-notificacion/{id}', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notification.markAsRead');



//TEST
Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test.index');



//ADMIN
Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
Route::get('/dashboard/usuarios', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('dashboard.user');
Route::get('/dashboard/historial-suscripciones', [App\Http\Controllers\Admin\AdminController::class, 'history'])->name('dashboard.history');
Route::get('/dashboard/historial-busquedas', [App\Http\Controllers\Admin\AdminController::class, 'search_history'])->name('dashboard.search_history');
Route::get('/dashboard/precios', [App\Http\Controllers\Admin\AdminController::class, 'price'])->name('dashboard.price');


Route::get('/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user.delete');
Route::get('/change-rol-pianista/{id}', [App\Http\Controllers\Admin\UserController::class, 'change_rol_pianista'])->name('user.change_pianista');
Route::get('/change-rol-premium/{id}', [App\Http\Controllers\Admin\UserController::class, 'change_rol_premium'])->name('user.change_premium');
Route::get('/ban/{id}', [App\Http\Controllers\Admin\UserController::class, 'ban'])->name('user.ban');
Route::get('/unban/{id}', [App\Http\Controllers\Admin\UserController::class, 'unban'])->name('user.unban');
Route::get('/verify/{id}', [App\Http\Controllers\Admin\UserController::class, 'verify'])->name('user.verify');
Route::get('/unverify/{id}', [App\Http\Controllers\Admin\UserController::class, 'unverify'])->name('user.unverify');

Route::post('/update-prices', [App\Http\Controllers\Admin\PriceController::class, 'update'])->name('price.update');