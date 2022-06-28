<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Repositories\Settings\Company\CompanyInterface;
use App\Repositories\Accounts\FinancialYear\FinancialYearInterface;
use App\Repositories\Accounts\ChartOfAccount\ChartOfAccountInterface;

class ChartOfAccountController extends Controller
{   
    use RespondsWithMessage;
    private $financialYear, $company, $chartOfAccount;
    public function __construct(
                FinancialYearInterface $financialYear, 
                CompanyInterface $company,
                ChartOfAccountInterface $chartOfAccount
            ){

        $this->financialYear = $financialYear;
        $this->company = $company;
        $this->chartOfAccount = $chartOfAccount;
    }


    public function index()
    {   
        $parentId = (isset($_GET['parentId'])) ? $_GET['parentId'] : 0;
        $data['companies'] = $this->company->allCompany();
        $data['chartOfAccounts'] = $this->chartOfAccount->getByParentId($parentId);
        $data['chartOfAccount'] = $this->chartOfAccount->getById($parentId);
        return view('Accounts.ChartOfAccount.index', $data);
    }

    public function add()
    {   
        $data['companies'] = $this->company->allCompany();
        return view('Accounts.ChartOfAccount.add', $data);
    }

    public function save(Request $request)
    {   

        $validated = $request->validate([
            'accHead' => 'required',
            'companyId' => 'required',
        ]);

        // sundray debtors
        if ($request->parentId == $this->chartOfAccount::FIXEDASSETID) {
            # create customer

        }
        $final = $this->chartOfAccount->saveChartOfAccount($request);
               
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
