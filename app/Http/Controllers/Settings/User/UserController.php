<?php

namespace App\Http\Controllers\Settings\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Repositories\Settings\User\UserInterface;
use App\Repositories\Settings\CompanyAssign\CompanyAssignInterface;
use App\Repositories\Settings\Company\CompanyInterface;

class UserController extends Controller
{
    use RespondsWithMessage;
    private $user, $companyAssign, $company;
    public function __construct(
        UserInterface $user,
        CompanyAssignInterface $companyAssign,
        CompanyInterface $company,
            ){
        $this->user = $user;
        $this->companyAssign = $companyAssign;
        $this->company = $company;
    }

    public function index()
    {
        $data['users'] = $this->user->gelAll();
        $data['companies'] = $this->company->allCompany();
        return view('Settings.user.index', $data);
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'companyId' => 'required'
        ]);

        $final = $this->user->saveUser($request);
        if($final != null){

            // assign a user in company
            $this->companyAssign->assign($request, $final->id);

            return back()->with('message', 
                $this->response(
                    $this->SUCCESSCLASS(), 
                    'Successfully added'
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
        $final = $this->user->update($request);

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
}
