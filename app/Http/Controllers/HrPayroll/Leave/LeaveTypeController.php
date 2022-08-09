<?php

namespace App\Http\Controllers\HrPayroll\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Services\HrPayroll\Leave\LeaveService;

class LeaveTypeController extends Controller
{   
    use RespondsWithMessage;

    public $leaveType;

    public function __construct(LeaveService $leaveType)
    {
        $this->leaveType = $leaveType;
    }

    public function index()
    {
        # code...
    }

    public function add()
    {
        return view('hrpayroll.leave.leaveType.add');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:leave_types'
        ]);

        $final = $this->leaveType->saveleaveType($request);
        if ($final) {
            return back()->with('message',
                $this->response(
                    $this->SUCCESSCLASS(),
                    'Leave type added successfully'
                )
            );
        }

        return back()->with('message', 
                $this->response(
                    $this->FAILURECLASS(), 
                    $this->FAILMESSAGE()
                )
            );
            
    }

}
