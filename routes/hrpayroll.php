<?php

use App\Http\Controllers\Accounts\DashboardController;
use App\Http\Controllers\HrPayroll\SystemInfo\DepartmentController;
use App\Http\Controllers\HrPayroll\SystemInfo\SectionController;
use App\Http\Controllers\HrPayroll\SystemInfo\DesignationController;
use App\Http\Controllers\HrPayroll\SystemInfo\ShiftController;
use App\Http\Controllers\HrPayroll\Employee\EmployeeController;
use App\Http\Controllers\HrPayroll\Leave\LeaveController;
use App\Http\Controllers\HrPayroll\Leave\LeaveTypeController;

Route::group([
    'prefix' => 'hrpayroll',
    'middleware' => ['UserGuard'],
    'namespace' => 'App\Http\Controllers'
], function () {

    Route::get('/', function(){
        return "dashboard";
    })->name('hrpayroll.dashboard');

    // Department 
    Route::group([
        'prefix' => 'department',
    ], function () {
        Route::get('/index', [DepartmentController::class, 'index'])->name('hrpayroll.department.index');
        Route::Post('/add', [DepartmentController::class, 'create'])->name('hrpayroll.department.create');
        Route::Post('/update', [DepartmentController::class, 'update'])->name('hrpayroll.department.update');
        Route::Post('/delete', [DepartmentController::class, 'delete'])->name('hrpayroll.department.delete');
    });

    // Section
    Route::group([
        'prefix' => 'section',
    ], function () {
        Route::get('/index', [SectionController::class, 'index'])->name('hrpayroll.section.index');
        Route::Post('/add', [SectionController::class, 'create'])->name('hrpayroll.section.create');
        Route::Post('/update', [SectionController::class, 'update'])->name('hrpayroll.section.update');
        Route::Post('/delete', [SectionController::class, 'delete'])->name('hrpayroll.section.delete');
    });
    
    // designation
    Route::group([
        'prefix' => 'designation',
    ], function () {
        Route::get('/index', [DesignationController::class, 'index'])->name('hrpayroll.designation.index');
        Route::Post('/add', [DesignationController::class, 'create'])->name('hrpayroll.designation.create');
        Route::Post('/update', [DesignationController::class, 'update'])->name('hrpayroll.designation.update');
        Route::Post('/delete', [DesignationController::class, 'delete'])->name('hrpayroll.designation.delete');
    });

    // shift
    Route::group([
        'prefix' => 'shift',
    ], function () {
        Route::get('/index', [ShiftController::class, 'index'])->name('hrpayroll.shift.index');
        Route::Post('/add', [ShiftController::class, 'create'])->name('hrpayroll.shift.create');
        Route::Post('/update', [ShiftController::class, 'update'])->name('hrpayroll.shift.update');
        Route::Post('/delete', [ShiftController::class, 'delete'])->name('hrpayroll.shift.delete');
    });

    // employee
    Route::group([
        'prefix' => 'employee',
    ], function () {
        Route::get('/index', [EmployeeController::class, 'index'])->name('hrpayroll.employee.index');
        Route::Get('/add', [EmployeeController::class, 'add'])->name('hrpayroll.employee.add');
        Route::Post('/add', [EmployeeController::class, 'create'])->name('hrpayroll.employee.create');
        Route::Post('/update', [EmployeeController::class, 'update'])->name('hrpayroll.employee.update');
        Route::Post('/delete', [EmployeeController::class, 'delete'])->name('hrpayroll.employee.delete');
    });

    // leave Type
    Route::group([
        'prefix' => 'leaveType',
    ], function () {
        Route::get('/index', [LeaveTypeController::class, 'index'])->name('hrpayroll.leaveType.index');
        Route::Get('/add', [LeaveTypeController::class, 'add'])->name('hrpayroll.leaveType.add');
        Route::Post('/add', [LeaveTypeController::class, 'create'])->name('hrpayroll.leaveType.create');
        Route::Post('/update', [LeaveTypeController::class, 'update'])->name('hrpayroll.leaveType.update');
        Route::Post('/delete', [LeaveTypeController::class, 'delete'])->name('hrpayroll.leaveType.delete');
    });

    // leave
    Route::group([
        'prefix' => 'leave',
    ], function () {
        Route::get('/index', [LeaveController::class, 'index'])->name('hrpayroll.leave.index');
        Route::Get('/add', [LeaveController::class, 'add'])->name('hrpayroll.leave.add');
        Route::Post('/add', [LeaveController::class, 'create'])->name('hrpayroll.leave.create');
        Route::Post('/update', [LeaveController::class, 'update'])->name('hrpayroll.leave.update');
        Route::Post('/delete', [LeaveController::class, 'delete'])->name('hrpayroll.leave.delete');
    });

});
