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
use PDF;

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

            $data['company'] = $this->company->getById($companyId);
        }

        
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $data['companyId'] = $companyId;
        $data['transType'] = $transType;

        // pdf view
        if ($request->input('submit') == "pdf"){
            $pdf = PDF::loadView('Accounts.reports.voucherList_pdf', $data);
            return $pdf->stream('document.pdf');
        }

        return view('Accounts.reports.vourcherlist', $data);
    }

    public function dailyCashSheet(Request $request)
    {   
        $data['companies'] = $this->company->userCompany();
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        $companyId = $request->companyId;
        $data['bankData'] = [];
        $data['cashData'] = [];

        if (isset($request->fromDate)) {
            $fromDate = Helper::dateBnToEn($request->fromDate);
            $data['bankData'] = $this->accTransaction->getBankData($request->companyId, $fromDate);
            $data['cashData'] = $this->accTransaction->getCashData($request->companyId, $fromDate);
        }
        
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $data['companyId'] = $companyId;
        return view('Accounts.reports.daily_cash_sheet', $data);
    }


    public function subsidaryLedger(Request $request)
    {   
        $data['companies'] = $this->company->userCompany();
        $defaultCompanyId = $this->company->getUserDefaultCompanyId();
        $companyId = $request->companyId;
        $data['accHeads'] = $this->accTransaction->acchead($transTypeNo = 1, $defaultCompanyId);
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        $data['vouchers'] = [];
        $data['opening'] = $this->accTransaction->getOpeningValueWithAccHead($companyId, $fromDate, null);
        $data['accHeadId'] = '';

        if (isset($request->fromDate)) {
            $fromDate = Helper::dateBnToEn($request->fromDate);
            $toDate = Helper::dateBnToEn($request->toDate);
            $ledgerId = $request->accHeadId;
            $data['vouchers'] = $this->accTransaction->getSubLedger($companyId, $fromDate, $toDate, $ledgerId);
            $data['opening'] = $this->accTransaction->getOpeningValueWithAccHead($companyId, $fromDate, $ledgerId);
            $data['accHeadId'] = $request->accHeadId;

        }

        
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $data['companyId'] = $companyId;
        return view('Accounts.reports.subsidary_ledger', $data);
    }

    public function controlWiseLedger(Request $request)
    {
        $data['companies'] = $this->company->userCompany();
        $companyId = $request->companyId;
        $data['controlWiseLedger'] = $this->accTransaction->controlWiseLedger(1);
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        $data['vouchers'] = [];
        $data['accHeadId'] = '';

        if (isset($request->fromDate)) {
            $fromDate = Helper::dateBnToEn($request->fromDate);
            $toDate = Helper::dateBnToEn($request->toDate);
            $ledgerId = $request->accHeadId;
            $data['vouchers'] = $this->accTransaction->getControlSubLedger($companyId, $fromDate, $toDate, $ledgerId);
            $data['accHeadId'] = $request->accHeadId;
            
        }

        
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $data['companyId'] = $companyId;
        return view('Accounts.reports.control_wise_ledger', $data);
    }


    public function trialBalance(Request $request)
    {
        $data['companies'] = $this->company->userCompany();
        $companyId = $request->companyId;
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        $data['vouchers'] = [];

        if (isset($request->fromDate)) {
            $fromDate = Helper::dateBnToEn($request->fromDate);
            $toDate = Helper::dateBnToEn($request->toDate);
            $data['vouchers'] = $this->accTransaction->getTrialBalance($companyId, $fromDate, $toDate);
            $data['companyId'] = $companyId;
        }

        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $data['companyId'] = $companyId;
        return view('Accounts.reports.trial_balance', $data);
    }

    public function liquidCash(Request $request)
    {
        $data['companies'] = $this->company->userCompany();
        $companyId = $request->companyId;
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        $data['vouchers'] = [];

        if (isset($request->fromDate)) {
            $fromDate = Helper::dateBnToEn($request->fromDate);
            $toDate = Helper::dateBnToEn($request->toDate);
            $data['vouchers'] = $this->accTransaction->getLiquidCash($companyId, $fromDate, $toDate);
            $data['companyId'] = $companyId;
        }

        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $data['companyId'] = $companyId;
        return view('Accounts.reports.liquid_cash', $data);
    }

    public function conBankToCash (Request $request)
    {
        $data['companies'] = $this->company->userCompany();
        $companyId = $request->companyId;
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        $data['vouchers'] = [];

        if (isset($request->fromDate)) {
            $fromDate = Helper::dateBnToEn($request->fromDate);
            $toDate = Helper::dateBnToEn($request->toDate);
            $data['vouchers'] = $this->accTransaction->getBankToCash($companyId, $fromDate, $toDate);
        }

        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $data['companyId'] = $companyId;
        return view('Accounts.reports.contra_bank_to_cash', $data);
    }
}
