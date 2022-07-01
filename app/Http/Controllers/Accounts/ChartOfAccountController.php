<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Repositories\Settings\Company\CompanyInterface;
use App\Repositories\Accounts\FinancialYear\FinancialYearInterface;
use App\Repositories\Accounts\ChartOfAccount\ChartOfAccountInterface;
use App\Repositories\Accounts\Transaction\AccTransactionDetails\AccTransactionDetailsInterface;

class ChartOfAccountController extends Controller
{   
    use RespondsWithMessage;
    private $financialYear, $company, $chartOfAccount, $accTransactionDetails;
    public function __construct(
                FinancialYearInterface $financialYear, 
                CompanyInterface $company,
                ChartOfAccountInterface $chartOfAccount,
                AccTransactionDetailsInterface $accTransactionDetails
            ){

        $this->financialYear = $financialYear;
        $this->company = $company;
        $this->chartOfAccount = $chartOfAccount;
        $this->accTransactionDetails = $accTransactionDetails;
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
        $final = $this->chartOfAccount->updateChartOfAccount($request);

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
        // $check = $this->accTransactionDetails->exist($request->id);
        if ($this->accTransactionDetails->exist($request->id)) {
            return back()->with('message', 
                $this->response(
                    $this->FAILURECLASS(), 
                    'You Cannot Delete, Transaction Already Exist'
                )
            );
        }
        $final = $this->chartOfAccount->deleteChartOfAccount($request->id);

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
