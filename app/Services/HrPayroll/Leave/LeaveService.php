<?php

namespace App\Services\HrPayroll\Leave;

use App\Models\HrPayroll\Leave\Leave;
use App\Models\HrPayroll\Leave\LeaveType;

class LeaveService {

    public $leave, $leaveType;

    public function __construct(Leave $leave, LeaveType $leaveType)
    {
        $this->leave = $leave;
    }

    // Leave Type ...........................................

    public function saveleaveType($request)
    {
        $type = new LeaveType();
        $type->name = $request->name;
        $type->status = 1;
        $type->save();

        if ($type->save()) {
            return true;
        }

        return false;
    }

    // End Leave type .......................................

    public function addLeave($request)
    {
        $leave = $this->leave;
        // $leave->
    }
}