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


    public function journalCreate($typeNo)
    {   
        $data['title'] = 'Journal Voucher Create';
        $data['companies'] = $this->company->all();
        $data['financialYear'] = $this->financialYear->active();
        $data['transType'] = $this->accTransaction->getType($typeNo);
        $data['title'] = $this->accTransaction->getTitle($typeNo);
        
        return view('Accounts.transactions.journal_create', $data);
    }

    public function acchead($transTypeNo, $companyId)
    {
        return $this->accTransaction->acchead($transTypeNo, $companyId);
    }
}
