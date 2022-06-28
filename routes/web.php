<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\Company\ConpanyController;

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