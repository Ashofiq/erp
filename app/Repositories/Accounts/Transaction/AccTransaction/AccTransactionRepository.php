<?php

namespace App\Repositories\Accounts\Transaction\AccTransaction;

use App\Repositories\Accounts\Transaction\AccTransaction\AccTransactionInterface as AccTransactionInterface;
use App\Models\Accounts\Transaction\AccTransaction;
use App\Models\Accounts\ChartOfAccount\ChartOfAccount;
use App\Enum\TransactionList;
use App\Enum\TransactionType;
use App\Enum\TransactionTitle;
use Config;
use DB;
use Helper;

class AccTransactionRepository implements AccTransactionInterface
{
    public $accTransaction;
    private $pagelimit;

    function __construct(AccTransaction $accTransaction) {
	    $this->accTransaction = $accTransaction;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function get($transType){
        return $this->accTransaction
        ->join('acc_transaction_details', 'acc_transaction_details.accTransId', '=', 'acc_transactions.id')
        ->TransFilter($transType)->select('acc_transaction_details.*', 'acc_transactions.*', 'acc_transactions.id as id')->paginate(2);
    }

    public function create($request){

        $this->accTransaction->companyId = $request->companyId;
        $this->accTransaction->transType = $request->transType;
        $this->accTransaction->voucherNo = self::getVoucherNo($request->companyId, $request->transType);
        $this->accTransaction->narration = $request->narration;
        $this->accTransaction->date      = Helper::dateBnToEn($request->transactionDate);
        $this->accTransaction->fiscalYearId = $request->fiscalYearId;
        if($this->accTransaction->save()){
            return $this->accTransaction;
        }

        return false;
    }

    public function update($id, $request)
    {   
        $accTransaction = $this->accTransaction->find($id);
        $accTransaction->companyId = $request->companyId;
        $accTransaction->narration = $request->narration;
        $accTransaction->date      = Helper::dateBnToEn($request->transactionDate);
        if($accTransaction->save()){
            return $accTransaction;
        }

        return false;
    }

    public function getById($id){
        return $this->accTransaction->with('details')->find($id);
    }

    public function getVoucherNo($companyId, $transType){
        $voucher =  $this->accTransaction->where('companyId', $companyId)
                                    ->where('transType', $transType)
                                    ->latest()->first();
        return ($voucher != null) ? $voucher->voucherNo + 1 : 1;
    }
    
    public function getType($typeNo)
    {
        if ($typeNo == TransactionList::JOURNAL) {
            return TransactionType::JOURNAL;
        }else if ($typeNo == TransactionList::CONTRA) {
            return TransactionType::CONTRA;
        }else if ($typeNo == TransactionList::CASHRECEIVE) {
            return TransactionType::CASHRECEIVE;
        }else if ($typeNo == TransactionList::CASHPAYMENT) {
            return TransactionType::CASHPAYMENT;
        }else if ($typeNo == TransactionList::BANKRECEIVE) {
            return TransactionType::BANKRECEIVE;
        }else if ($typeNo == TransactionList::BANKPAYMENT) {
            return TransactionType::BANKPAYMENT;
        }
    }

    public function getTitle($typeNo)
    {
        if ($typeNo == TransactionList::JOURNAL) {
            return TransactionTitle::JOURNAL;
        }else if ($typeNo == TransactionList::CONTRA) {
            return TransactionTitle::CONTRA;
        }else if ($typeNo == TransactionList::CASHRECEIVE) {
            return TransactionTitle::CASHRECEIVE;
        }else if ($typeNo == TransactionList::CASHPAYMENT) {
            return TransactionTitle::CASHPAYMENT;
        }else if ($typeNo == TransactionList::BANKRECEIVE) {
            return TransactionTitle::BANKRECEIVE;
        }else if ($typeNo == TransactionList::BANKPAYMENT) {
            return TransactionTitle::BANKPAYMENT;
        }
        
        
    }

    public function  getTypeNo($transType)
    {
        if ($transType == TransactionType::JOURNAL) {
            return TransactionList::JOURNAL;
        }else if ($transType == TransactionType::CONTRA) {
            return TransactionList::CONTRA;
        }else if ($transType == TransactionType::CASHRECEIVE) {
            return TransactionList::CASHRECEIVE;
        }else if ($transType == TransactionType::CASHPAYMENT) {
            return TransactionList::CASHPAYMENT;
        }else if ($transType == TransactionType::BANKRECEIVE) {
            return TransactionList::BANKRECEIVE;
        }else if ($transType == TransactionType::BANKPAYMENT) {
            return TransactionList::BANKPAYMENT;
        }
    }


    public function acchead($transTypeNo, $companyId)
    {   
        $ext = '';
        if ($transTypeNo == TransactionList::JOURNAL) {
            
        }else if ($transTypeNo == TransactionList::CONTRA) {
            $ext = 'and parentId in ('. ChartOfAccount::CASHATBANKID.','. ChartOfAccount::CASHINHAND.')';
        }else if ($transTypeNo == TransactionList::CASHRECEIVE) {
            
        }else if ($transTypeNo == TransactionList::CASHPAYMENT) {
            
        }else if ($transTypeNo == TransactionList::BANKRECEIVE) {

        }else if ($transTypeNo == TransactionList::BANKPAYMENT) {

        }

        $sql = "select * from `chart_of_accounts`
        where `companyId` = $companyId $ext and `id` not in (select `parentId` from `chart_of_accounts`)
        Order By accHead asc";
        return DB::select($sql);
    }
}