<?php

namespace App\Http\Controllers\HrPayroll\SystemInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Repositories\HrPayroll\SystemInfo\Designation\DesignationInterface;
use App\Repositories\Settings\Company\CompanyInterface;

class DesignationController extends Controller
{   
    use RespondsWithMessage;
    private $designation;
    public function __construct(
        DesignationInterface $designation,
        CompanyInterface $company,
            ){
        $this->company = $company;
        $this->designation = $designation;
    }

    public function index()
    {   
        $data['companies'] = $this->company->allCompany();
        $data['designations'] = $this->designation->getAll();
        return view('hrpayroll.systeminfo.designation.index', $data);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:designations',
            'description' => 'required',
        ]);

        $final = $this->designation->saveDesignation($request);
               
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
            'name' => 'required|unique:designations,name,'.$request->id,
            'description' => 'required',
        ]);

        $final = $this->designation->updateDesignation($request);
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
        if ($this->designation->exist($request->id)) {
            return back()->with('message', 
                $this->response(
                    $this->FAILURECLASS(), 
                    'You Cannot Delete, Designation Already Used'
                )
            );
        }
        $final = $this->designation->deleteDesignation($request->id);

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
