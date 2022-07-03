<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Accounts\FinancialYear\FinancialYearInterface;
use App\Helper\RespondsWithMessage;
use App\Repositories\Settings\Company\CompanyInterface;
use App\Repositories\Accounts\ChartOfAccount\ChartOfAccountInterface;
use App\Repositories\Accounts\Transaction\AccTransaction\AccTransactionInterface;
use App\Repositories\Accounts\Transaction\AccTransactionDetails\AccTransactionDetailsInterface;
use App\Enum\TransactionTitle;
use Helper;

class ReportController extends Controller
{   
    use RespondsWithMessage;
    private $financialYear, $company, $chartOfAccount, $accTransaction, $accTransactionDetails;
    public function __construct(
        FinancialYearInterface $financialYear, 
        CompanyInterface $company,
        ChartOfAccountInterface $chartOfAccount,
        AccTransactionInterface $accTransaction,
        AccTransactionDetailsInterface $accTransactionDetails
    ){
        $this->financialYear = $financialYear;
        $this->company = $company;
        $this->accTransaction = $accTransaction;
        $this->accTransactionDetails = $accTransactionDetails;
        $this->chartOfAccount = $chartOfAccount;
    }

    public function voucherReport(Request $request)
    {   
        // return $request;
        // return Helper::dateBnToEn($request->fromDate);
        $data['companies'] = $this->company->userCompany();
        $data['transTypes'] = $this->accTransaction->transTypes();
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        $transType = $request->transType;
        $companyId = $request->companyId;
        $data['vouchers'] = [];

        if (isset($request->fromDate) && isset($request->toDate)) {
            $fromDate = Helper::dateBnToEn($request->fromDate);
            $toDate = Helper::dateBnToEn($request->toDate);

            $data['vouchers'] = $this->accTransaction->getVoucherList($request->companyId, 
            $request->transType, $fromDate, $toDate);
            
        }

        
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $data['companyId'] = $companyId;
        $data['transType'] = $transType;
        // return $data;
        return view('Accounts.reports.vourcherlist', $data);
    }
}
