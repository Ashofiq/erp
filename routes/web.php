<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\Company\ConpanyController;
use App\Http\Controllers\Settings\User\UserController;
use App\Http\Controllers\Settings\Company\CompanyAssignController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// company
Route::group([
    'prefix' => 'setting/company',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::get('add', [ConpanyController::class, 'add'])->name('settings.company.add');
    Route::Post('add', [ConpanyController::class, 'save'])->name('settings.company.save');
    Route::get('all', [ConpanyController::class, 'index'])->name('settings.company.all');

});

// User
Route::group([
    'prefix' => 'setting/user',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::Post('add', [UserController::class, 'save'])->name('settings.user.save');
    Route::get('all', [UserController::class, 'index'])->name('settings.user.all');
    Route::Post('update', [UserController::class, 'update'])->name('settings.user.update');
});

// company Assign
Route::group([
    'prefix' => 'setting/company-assign',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::Post('add', [CompanyAssignController::class, 'save'])->name('settings.company.assign.save');
    Route::get('all', [CompanyAssignController::class, 'index'])->name('settings.company.assign.all');
    Route::Post('update', [CompanyAssignController::class, 'update'])->name('settings.company.assign.update');
    Route::Post('delete', [CompanyAssignController::class, 'delete'])->name('settings.company.assign.delete');

});