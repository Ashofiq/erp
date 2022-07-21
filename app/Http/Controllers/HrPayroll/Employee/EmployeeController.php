<?php

namespace App\Http\Controllers\HrPayroll\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Repositories\HrPayroll\Employee\EmployeeInterface;
use App\Repositories\Settings\Company\CompanyInterface;
use App\Repositories\HrPayroll\SystemInfo\Department\DepartmentInterface;
use App\Repositories\HrPayroll\SystemInfo\Designation\DesignationInterface;
use App\Repositories\HrPayroll\SystemInfo\Section\SectionInterface;
use App\Repositories\HrPayroll\SystemInfo\Shift\ShiftInterface;

class EmployeeController extends Controller
{   
    use RespondsWithMessage;
    private $employee, $department, $designation;
    public function __construct(
        EmployeeInterface $employee,
        CompanyInterface $company,
        DepartmentInterface $department,
        DesignationInterface $designation,
        SectionInterface $section,
        ShiftInterface $shift,
            ){
        $this->company = $company;
        $this->employee = $employee;
        $this->department = $department;
        $this->designation = $designation;
        $this->section = $section;
        $this->shift = $shift;
    }

    public function index()
    {   
        $data['employees'] = $this->employee->getAll();
        return view('hrpayroll.employee.index', $data);
    }

    public function add()
    {
        $data['employees'] = $this->employee->getAll();
        $data['departments'] = $this->department->getAll();
        $data['designations'] = $this->designation->getAll();
        $data['sections'] = $this->section->getAll();
        $data['shifts'] = $this->shift->getAll();
        return view('hrpayroll.employee.add', $data);
    }

    public function save(Request $request)
    {
        // dd($request);
        // $validated = $request->validate([
        //     'employId' => 'required|unique:employees',
        //     'name' => 'required',
        //     'departmentId' => 'required',
        //     'sectionId' => 'required',
        //     'designationId' => 'required',
        //     'shiftId' => 'required',

        // ]);
        $result = $this->employee->saveEmployee($request);
        if($result){
            return back()->with('message', 
                $this->response(
                    $this->SUCCESSCLASS(), 
                    'Successfully Added'
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
