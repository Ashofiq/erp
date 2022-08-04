<?php

namespace App\Repositories\HrPayroll\Employee;

use App\Repositories\HrPayroll\Employee\EmployeeInterface as EmployeeInterface;
use App\Models\HrPayroll\Employee\Employee;
use Config;

class EmployeeRepository implements EmployeeInterface
{
    public $employee;
    private $pagelimit;
    
    function __construct(Employee $employee) {
	    $this->employee = $employee;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function getAll()
    {
        return $this->employee->get();
    }
    
    public function saveEmployee($request){

        $chectEmployee = $this->employee->where('employeeId', $request->employeeId)->first();
        if ($chectEmployee != null) {
            throw new Exception("employee Id is exist", 1);
        }

        $employee = new $this->employee;
        $employee->name             = $request->name;
        $employee->employeeId       = $request->employeeId;
        $employee->departmentId     = $request->departmentId;
        $employee->sectionId        = $request->sectionId;
        $employee->designationId    = $request->designationId;
        $employee->shiftId          = $request->shiftId;
        $employee->headOfDepartment = $request->headOfDepartment;
        $employee->reportingTo      = $request->reportingTo;
        $employee->empType          = $request->empType;
        $employee->pfMember         = $request->pfMember;
        $employee->joiningDate      = $request->joiningDate;
        $employee->jobLocation      = $request->jobLocation;
        $employee->grossSalary      = $request->grossSalary;
        if ($employee->save()) {
            return $employee;
        }
        return false;
    }

}