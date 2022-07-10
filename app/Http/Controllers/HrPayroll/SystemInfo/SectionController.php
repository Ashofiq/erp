<?php

namespace App\Http\Controllers\HrPayroll\SystemInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Repositories\HrPayroll\SystemInfo\Section\SectionInterface;
use App\Repositories\Settings\Company\CompanyInterface;

class SectionController extends Controller
{
    use RespondsWithMessage;
    private $section;
    public function __construct(
        SectionInterface $section,
        CompanyInterface $company,
            ){
        $this->company = $company;
        $this->section = $section;
    }

    public function index()
    {   
        $data['companies'] = $this->company->allCompany();
        $data['sections'] = $this->section->getAll();
        return view('hrpayroll.systeminfo.section.index', $data);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:sections',
            'description' => 'required',
        ]);

        $final = $this->section->saveSection($request);
               
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
            'name' => 'required|unique:sections,name,'.$request->id,
            'description' => 'required',
        ]);

        $final = $this->section->updateSection($request);
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
        if ($this->section->exist($request->id)) {
            return back()->with('message', 
                $this->response(
                    $this->FAILURECLASS(), 
                    'You Cannot Delete, Section Already Used'
                )
            );
        }
        $final = $this->section->deleteSection($request->id);

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
