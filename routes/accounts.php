<?php
use App\Http\Controllers\Accounts\FinancialYearController;
use App\Http\Controllers\Accounts\ChartOfAccountController;
use App\Http\Controllers\Accounts\TransactionController;
use App\Http\Controllers\Accounts\ReportController;


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
    Route::Post('update', [ChartOfAccountController::class, 'update'])->name('accounts.chart.of.acc.update');
    Route::Post('delete', [ChartOfAccountController::class, 'delete'])->name('accounts.chart.of.acc.delete');
});

// transaction
Route::group([
    'prefix' => 'account/acctrans',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::get('create/{id}', [TransactionController::class, 'journalCreate'])->name('accounts.acctrans.jv.create');
    Route::get('acchead/{transTypeNo}/{companyId}', [TransactionController::class, 'acchead'])->name('accounts.acchead');
    Route::Post('create', [TransactionController::class, 'accTransCreate'])->name('accounts.acc.trans.create');
    Route::Get('edit/{id}', [TransactionController::class, 'voucherEdit'])->name('accounts.acc.trans.edit');
    Route::Post('update/{id}', [TransactionController::class, 'voucherUpdate'])->name('accounts.acc.trans.update');
    Route::Get('list/{transTypeNo}', [TransactionController::class, 'index'])->name('accounts.acc.trans.index');
});

// Reports
Route::group([
    'prefix' => 'account/report',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::any('voucher-list', [ReportController::class, 'voucherReport'])->name('accounts.acctrans.voucher.list');
    Route::any('cash-sheet', [ReportController::class, 'dailyCashSheet'])->name('accounts.acctrans.cash.sheet');
    Route::any('subsidary-ledger', [ReportController::class, 'subsidaryLedger'])->name('accounts.acctrans.subsidary.ledger');
    Route::any('control-wise-ledger', [ReportController::class, 'controlWiseLedger'])->name('accounts.control.wise.ledger');

});