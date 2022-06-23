<?php

namespace App\Http\Controllers\Settings\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Settings\Company\CompanyInterface;
use App\Helper\RespondsWithMessage;

class ConpanyController extends Controller
{   
    use RespondsWithMessage;
    private $company;

    public function __construct(CompanyInterface $company){
        $this->company = $company;
    }

    public function index()
    {   
        $data['companies'] = $this->company->allCompany();
        return view('settings.company.index', $data);
    }

    public function add()
    {
        return view('settings.company.add');
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:companies',
        ]);

        $request->lavel = $this->company->latestOne()?->lavel + 1;

        $final = $this->company->saveCompany($request);
        if($final){
            return back()->with('message', 
                $this->response(
                    $this->SUCCESSCLASS(), 
                    $this->SUCCESSMESSAGE()
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
