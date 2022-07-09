<?php

use App\Http\Controllers\Accounts\DashboardController;

Route::group([
    'prefix' => 'hrpayroll',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {
    // Route::get('/', [DashboardController::class, 'index'])->name('accounts.dashboard');
    Route::get('/', function(){
        return "ok";
    })->name('hr');
});
