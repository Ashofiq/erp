<?php
use App\Http\Controllers\Accounts\FinancialYearController;
use App\Http\Controllers\Accounts\ChartOfAccountController;
use App\Http\Controllers\Accounts\TransactionController;

// chart of account
Route::group([
    'prefix' => 'account/fiscalyear',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::get('add', [FinancialYearController::class, 'add'])->name('accounts.fiscal.year.add');
    Route::Post('add', [FinancialYearController::class, 'save'])->name('accounts.fiscal.year.save');
    Route::get('index', [FinancialYearController::class, 'index'])->name('accounts.fiscal.year.all');

});

// chart of account
Route::group([
    'prefix' => 'account/chart-of-account',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::get('index', [ChartOfAccountController::class, 'index'])->name('accounts.chart.of.acc.index');
    Route::get('add', [ChartOfAccountController::class, 'add'])->name('accounts.chart.of.acc.add');
    Route::Post('add', [ChartOfAccountController::class, 'save'])->name('accounts.chart.of.acc.save');

});

// transaction
Route::group([
    'prefix' => 'account/acctrans',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::get('create/{id}', [TransactionController::class, 'journalCreate'])->name('accounts.acctrans.jv.create');
    Route::get('acchead/{transTypeNo}/{companyId}', [TransactionController::class, 'acchead'])->name('accounts.acchead');
    Route::Post('add', [TransactionController::class, 'save'])->name('accounts.chart.of.acc.save');

});