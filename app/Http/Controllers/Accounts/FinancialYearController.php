<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Accounts\FinancialYear\FinancialYearInterface;
use App\Helper\RespondsWithMessage;
use App\Repositories\Settings\Company\CompanyInterface;

class FinancialYearController extends Controller
{   
    use RespondsWithMessage;
    private $financialYear, $company;
    public function __construct(FinancialYearInterface $financialYear, CompanyInterface $company){
        $this->financialYear = $financialYear;
        $this->company = $company;
    }

    public function index()
    {   
        $data['financialYears'] = $this->financialYear->all();
        return view('Accounts.FinancialYear.index', $data);
    }

    public function add()
    {   
        $data['companies'] = $this->company->allCompany();
        return view('Accounts.FinancialYear.add', $data);
    }

    public function save(Request $request)
    {   
        $validated = $request->validate([
            'fromDate' => 'required',
            'toDate' => 'required',
            'companyId' => 'required',
        ]);

        $request->serial = $this->financialYear->latestOne()?->serial + 1;
        $request->status = ($request->status == 'on') ? 1 : 0;

        $final = $this->financialYear->saveFinancialYear($request);
        if ($request->status == 1) {
            // update and deactive 
            $this->financialYear->checkAndDeactive($request->companyId);
        }
        
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
