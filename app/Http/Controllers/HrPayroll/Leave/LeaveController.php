<?php

namespace App\Http\Controllers\HrPayroll\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HrPayroll\Leave\LeaveService;

class LeaveController extends Controller
{   
    public $leave;

    public function __construct(LeaveService $leave)
    {
        $this->leave = $leave;
    }

    public function index()
    {
        # code...
    }

    public function add()
    {
        return view('hrpayroll.leave.leaveType.add');
    }
}
