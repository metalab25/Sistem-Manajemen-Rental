<?php

use App\Models\KasMasuk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasKeluarController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/web-admin', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/web-admin', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::resource('/setting/company', CompanyController::class)->middleware('auth')->middleware('auth');
Route::get('/setting/application', [ConfigController::class, 'index'])->name('application.index')->middleware('auth');
Route::put('/setting/application/{config}', [ConfigController::class, 'update'])->name('application.update')->middleware('auth');
Route::resource('/setting/users', UserController::class)->middleware('auth');
Route::get('/profile/{user}', [UserController::class, 'profile'])->name('users.profile')->middleware('auth');
Route::put('/profile/{user}', [UserController::class, 'updateAccount'])->name('users.updateAccount')->middleware('auth');
Route::resource('/setting/roles', RoleController::class)->middleware('auth');
Route::resource('/data/owners', OwnerController::class)->middleware('auth');

Route::put('data/cars/{id}', [CarController::class, 'updateStatus'])->name('cars.updateStatus')->middleware('auth');
Route::resource('/data/cars', CarController::class)->middleware('auth');

Route::resource('/data/customers', CustomerController::class)->middleware('auth');

Route::put('/rentals/done/{id}', [RentalController::class, 'updateDone'])->name('rentals.done')->middleware('auth');
Route::resource('/rentals', RentalController::class)->middleware('auth');
Route::get('/rentals/{rental}/print', [RentalController::class, 'print'])->name('rentals.print')->middleware('auth');

Route::get('/accountancy/cashins/print', [KasMasukController::class, 'print'])->name('cashins.print')->middleware('auth');
Route::resource('/accountancy/cashins', KasMasukController::class)->middleware('auth');

Route::get('/accountancy/cashouts/print', [KasKeluarController::class, 'print'])->name('cashouts.print')->middleware('auth');
Route::resource('/accountancy/cashouts', KasKeluarController::class)->middleware('auth');

Route::get('/accountancy/reports', [ReportController::class, 'index'])->name('reports.index')->middleware('auth');
