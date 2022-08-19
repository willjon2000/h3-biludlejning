<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingContactController;
use App\Http\Controllers\BookingAddonController;
use App\Http\Controllers\BookingVehicleController;

use Illuminate\Support\Facades\Route;


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
    return redirect()->intended('booking/create');
});

Route::get('login', [LoginController::class, 'index']);
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('users', [UserController::class, 'index'])->name('user.index');
Route::get('user/create', [UserController::class, 'create'])->name('user.create');
Route::post('user/create', [UserController::class, 'store'])->name('user.store');
Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('user/{id}/edit', [UserController::class, 'update'])->name('user.update');
Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('bookings', [BookingController::class, 'index'])->name('booking.index');
Route::get('booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('booking/create', [BookingController::class, 'store'])->name('booking.store');
Route::get('booking/{id}', [BookingController::class, 'show'])->name('booking.show');
Route::get('booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
Route::put('booking/{id}/edit', [BookingController::class, 'update'])->name('booking.update');
Route::delete('booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');

Route::get('contacts', [BookingContactController::class, 'index'])->name('contact.index');
Route::get('contact/{id}', [BookingContactController::class, 'show'])->name('contact.show');
Route::get('contact/{id}/edit', [BookingContactController::class, 'edit'])->name('contact.edit');
Route::put('contact/{id}/edit', [BookingContactController::class, 'update'])->name('contact.update');
Route::delete('contact/{id}', [BookingContactController::class, 'destroy'])->name('contact.destroy');

Route::get('addons', [BookingAddonController::class, 'index'])->name('addon.index');
Route::get('addon/create', [BookingAddonController::class, 'create'])->name('addon.create');
Route::post('addon/create', [BookingAddonController::class, 'store'])->name('addon.store');
Route::get('addon/{id}/edit', [BookingAddonController::class, 'edit'])->name('addon.edit');
Route::put('addon/{id}/edit', [BookingAddonController::class, 'update'])->name('addon.update');
Route::delete('addon/{id}', [BookingAddonController::class, 'destroy'])->name('addon.destroy');

Route::get('vehicles', [BookingVehicleController::class, 'index'])->name('vehicle.index');
Route::get('vehicle/create', [BookingVehicleController::class, 'create'])->name('vehicle.create');
Route::post('vehicle/create', [BookingVehicleController::class, 'store'])->name('vehicle.store');
Route::get('vehicle/{id}/edit', [BookingVehicleController::class, 'edit'])->name('vehicle.edit');
Route::put('vehicle/{id}/edit', [BookingVehicleController::class, 'update'])->name('vehicle.update');
Route::delete('vehicle/{id}', [BookingVehicleController::class, 'destroy'])->name('vehicle.destroy');