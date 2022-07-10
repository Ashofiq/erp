<?php

namespace App\Http\Controllers\HrPayroll\SystemInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Repositories\HrPayroll\SystemInfo\Department\DepartmentInterface;
use App\Repositories\Settings\Company\CompanyInterface;

class DepartmentController extends Controller
{   
    use RespondsWithMessage;
    private $department;
    public function __construct(
        DepartmentInterface $department,
        CompanyInterface $company,
            ){
        $this->company = $company;
        $this->department = $department;
    }

    public function index()
    {   
        $data['companies'] = $this->company->allCompany();
        $data['departments'] = $this->department->getAll();
        return view('hrpayroll.systeminfo.department.index', $data);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:departments',
            'description' => 'required',
        ]);

        $final = $this->department->saveDepartment($request);
               
        if($final){
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

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:departments,name,'.$request->id,
            'description' => 'required',
        ]);

        $final = $this->department->updateDepartment($request);
        if($final){

            return back()->with('message', 
                $this->response(
                    $this->SUCCESSCLASS(), 
                    'Update Successfully'
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

    public function delete(Request $request)
    {   
        if ($this->department->exist($request->id)) {
            return back()->with('message', 
                $this->response(
                    $this->FAILURECLASS(), 
                    'You Cannot Delete, Department Already Used'
                )
            );
        }
        $final = $this->department->deleteDepartment($request->id);

        if($final){
            
            return back()->with('message', 
                $this->response(
                    $this->SUCCESSCLASS(), 
                    'Delete Successfully'
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
