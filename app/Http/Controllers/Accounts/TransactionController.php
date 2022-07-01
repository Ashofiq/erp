<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Settings\Company\CompanyInterface;
use App\Repositories\Accounts\FinancialYear\FinancialYearInterface;
use App\Repositories\Accounts\ChartOfAccount\ChartOfAccountInterface;
use App\Repositories\Accounts\Transaction\AccTransaction\AccTransactionInterface;
use App\Repositories\Accounts\Transaction\AccTransactionDetails\AccTransactionDetailsInterface;
use App\Helper\RespondsWithMessage;

class TransactionController extends Controller
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

    public function index($typeNo)
    {   
        $transType = $this->accTransaction->getType($typeNo);
        $data['accTrans'] = $this->accTransaction->get($transType);
        $data['title'] = $this->accTransaction->getTitle($typeNo);
        $data['typeNo'] = $typeNo;

        return view('Accounts.transactions.voucher_list', $data);
    }

    public function journalCreate($typeNo)
    {   
        $data['companies'] = $this->company->all();
        $data['financialYear'] = $this->financialYear->active();
        $data['transType'] = $this->accTransaction->getType($typeNo);
        $data['title'] = $this->accTransaction->getTitle($typeNo);
        $data['typeNo'] = $typeNo;

        return view('Accounts.transactions.journal_create', $data);
    }

    // acc trans create 
    public function accTransCreate(Request $request)
    {       
        // return $request;
        $validated = $request->validate([
            'companyId' => 'required',
            'narration' => 'required',
            'transactionDate' => 'required'
        ]);
        $accTrans = $this->accTransaction->create($request);
        if ($accTrans != null) {
            $request->accTransId = $accTrans->id;
            $this->accTransactionDetails->create($request);
        }

        return back()->with('message', 
            $this->response(
                $this->SUCCESSCLASS(), 
                $this->SUCCESSMESSAGE()
            )
        );
    }

    public function voucherEdit($id, Request $request)
    {   
        $data['companies'] = $this->company->all();
        $data['financialYear'] = $this->financialYear->active();
        $vouchers = $this->accTransaction->getById($id);
        $typeNo = $this->accTransaction->getTypeNo($vouchers->transType);
        $data['title'] = $this->accTransaction->getTitle($typeNo);
        $data['vouchers'] = $vouchers;
        $data['acchead'] = $this->accTransaction->acchead($typeNo,  $vouchers->companyId);
        $data['typeNo'] = $typeNo;
        return view('Accounts.transactions.voucher_edit', $data);
    }

    public function voucherUpdate($id, Request $request)
    {
        $accTrans = $this->accTransaction->update($id, $request);
        if ($accTrans != null) {
            $request->accTransId = $accTrans->id;
            $this->accTransactionDetails->update($id, $request);
        }

        return back()->with('message', 
            $this->response(
                $this->SUCCESSCLASS(), 
                'Successfully update'
            )
        );
    }

    public function acchead($transTypeNo, $companyId)
    {
        return $this->accTransaction->acchead($transTypeNo, $companyId);
    }
}
