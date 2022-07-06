<?php

namespace App\Http\Controllers\Settings\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Repositories\Settings\Company\CompanyInterface;
use App\Repositories\Settings\CompanyAssign\CompanyAssignInterface;
use App\Repositories\Settings\User\UserInterface;

class CompanyAssignController extends Controller
{   
    use RespondsWithMessage;
    private $company, $companyAssign, $user;
    public function __construct(
                CompanyInterface $company,
                CompanyAssignInterface $companyAssign,
                UserInterface $user
            ){
        $this->companyAssign = $companyAssign;
        $this->company = $company;
        $this->user = $user;
    }

    public function index()
    {
        $data['companyAssigns'] = $this->companyAssign->getAll();
        $data['companies'] = $this->company->allCompany();
        $data['users'] = $this->user->all();
        return view('settings.companyAssign.index', $data);
    }

    public function save(Request $request)
    {   
        $data = $this->companyAssign->assign($request, $request->userId);
        if ($data != null) {
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

    public function delete(Request $request)
    {
        if ($this->companyAssign->delete($request)) {
            return back()->with('message', 
                $this->response(
                    $this->SUCCESSCLASS(), 
                    'Successfully Delete'
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
        $data = $this->companyAssign->update($request);
        if ($data != null) {
            return back()->with('message', 
                $this->response(
                    $this->SUCCESSCLASS(), 
                    'Successfully Updated'
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
