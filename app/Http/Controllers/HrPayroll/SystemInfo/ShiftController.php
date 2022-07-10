<?php

namespace App\Http\Controllers\HrPayroll\SystemInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Repositories\HrPayroll\SystemInfo\Shift\ShiftInterface;
use App\Repositories\Settings\Company\CompanyInterface;

class ShiftController extends Controller
{
    use RespondsWithMessage;
    private $shift;
    public function __construct(
        ShiftInterface $shift,
        CompanyInterface $company,
            ){
        $this->company = $company;
        $this->shift = $shift;
    }

    public function index()
    {   
        $data['companies'] = $this->company->allCompany();
        $data['shifts'] = $this->shift->getAll();
        return view('hrpayroll.systeminfo.shift.index', $data);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:shifts',
            'description' => 'required',
        ]);

        $final = $this->shift->saveShift($request);
               
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
            'name' => 'required|unique:shifts,name,'.$request->id,
            'description' => 'required',
        ]);

        $final = $this->shift->updateShift($request);
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
        if ($this->shift->exist($request->id)) {
            return back()->with('message', 
                $this->response(
                    $this->FAILURECLASS(), 
                    'You Cannot Delete, shift Already Used'
                )
            );
        }
        $final = $this->shift->deleteShift($request->id);

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
