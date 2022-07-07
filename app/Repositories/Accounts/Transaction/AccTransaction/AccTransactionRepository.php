<?php

namespace App\Repositories\Accounts\Transaction\AccTransaction;

use App\Repositories\Accounts\Transaction\AccTransaction\AccTransactionInterface as AccTransactionInterface;
use App\Models\Accounts\Transaction\AccTransaction;
use App\Models\Accounts\ChartOfAccount\ChartOfAccount;
use App\Enum\TransactionList;
use App\Enum\TransactionType;
use App\Enum\TransactionTitle;
use App\Enum\LedgerEnum;
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
        return $this->accTransaction->with('details')
        ->join('acc_transaction_details', 'acc_transaction_details.accTransId', '=', 'acc_transactions.id')
        ->TransFilter($transType)->select('acc_transaction_details.*', 'acc_transactions.*', 'acc_transactions.id as id')
        ->orderBy('date', 'DESC')
        ->paginate(2);
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

    public function delete($request){
        
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

    public function transTypes(){
        return [
            TransactionType::JOURNAL => TransactionTitle::JOURNAL,
            TransactionType::CONTRA => TransactionTitle::CONTRA,
            TransactionType::CASHRECEIVE => TransactionTitle::CASHRECEIVE,
            TransactionType::CASHPAYMENT => TransactionTitle::CASHPAYMENT,
            TransactionType::BANKRECEIVE => TransactionTitle::BANKRECEIVE,
            TransactionType::BANKPAYMENT => TransactionTitle::BANKPAYMENT,
        ];
    }

    public function getVoucherList($companyId, $transType, $fromDate, $toDate){
        return $this->accTransaction->with('details')
            ->where('companyId', $companyId)
            ->where('transType', $transType)
            ->whereBetween('date', [$fromDate, $toDate])
            ->get();
    }

    public function getBankData($companyId, $fromDate){
        return $this->accTransaction
        ->join('acc_transaction_details', 'acc_transaction_details.accTransId', '=', 'acc_transactions.id')
        ->join('chart_of_accounts', 'chart_of_accounts.id', '=', 'acc_transaction_details.chartOfAccId')
        ->whereBetween('acc_transactions.date', [$fromDate, $fromDate])
        ->where('transType', TransactionType::BANKRECEIVE)
        ->where('dAmount', '<>', null)
        ->where('acc_transactions.companyId', $companyId)
        ->get();
    }

    public function getCashData($companyId, $fromDate){
        return $this->accTransaction
        ->join('acc_transaction_details', 'acc_transaction_details.accTransId', '=', 'acc_transactions.id')
        ->join('chart_of_accounts', 'chart_of_accounts.id', '=', 'acc_transaction_details.chartOfAccId')
        ->whereBetween('acc_transactions.date', [$fromDate, $fromDate])
        ->where('transType', TransactionType::CASHRECEIVE)
        ->where('acc_transactions.companyId', $companyId)
        ->get();
    }

    public function getOpeningValueWithAccHead($companyId, $fromDate, $ledgerId){

        return $this->accTransaction
                    ->join('acc_transaction_details', 'acc_transaction_details.accTransId', '=', 'acc_transactions.id')
                    ->join('chart_of_accounts', 'chart_of_accounts.id', '=', 'acc_transaction_details.chartOfAccId')
                    ->where('acc_transactions.companyId', $companyId)
                    ->where('chart_of_accounts.companyId', $companyId)
                    ->whereDate('date', '<',$fromDate)
                    ->where('chart_of_accounts.id', $ledgerId)
                    ->selectRaw('ifnull(sum(dAmount),0) as debit, ifnull(sum(cAmount),0) as credit')
                    ->first();
    }

    public function getSubLedger($companyId, $fromDate, $toDate, $ledgerId){
        return $this->accTransaction
            ->join('acc_transaction_details', 'acc_transaction_details.accTransId', '=', 'acc_transactions.id')
            ->join('chart_of_accounts', 'chart_of_accounts.id', '=', 'acc_transaction_details.chartOfAccId')
            ->where('acc_transactions.companyId', $companyId)
            ->whereBetween('acc_transactions.date', [$fromDate, $toDate])
            ->where('chart_of_accounts.id', $ledgerId)
            ->get();
    }

    public function controlWiseLedger($companyId)
    {   
        return DB::table('chart_of_accounts as c')
            ->join('chart_of_accounts as p', 'p.id', '=', 'c.parentId')
            ->where('c.companyId', $companyId)
            ->select('p.id as id', 'p.accHead as accHead')
            ->whereNotIn('c.id', function($q){ 
                $q->select('parentId')->from('chart_of_accounts');
            })
            ->distinct()
            ->get();
    }

    public function getControlSubLedger($companyId, $fromDate, $toDate, $ledgerId)
    {
        return DB::select("SELECT accHead, SUM(op_d_amount) as op_debit, SUM(op_c_amount) as op_credit ,
        SUM(t_d_amount) as tr_debit,SUM(t_c_amount) as tr_credit
        FROM
        (SELECT c.accHead as accHead,SUM(dAmount) as op_d_amount,SUM(cAmount) as op_c_amount, 0 as t_d_amount,0 as t_c_amount
        FROM acc_transactions t
        INNER JOIN acc_transaction_details on t.id = accTransId
        INNER JOIN chart_of_accounts c on c.id = chartOfAccId 
        inner join chart_of_accounts p on p.id = c.parentId
        Where t.companyId =  $companyId and c.parentId = ".$ledgerId." AND t.date < '". $fromDate ."'
        GROUP BY c.accHead
        UNION ALL
        SELECT c.accHead as accHead,0 as op_d_amount,0 as op_c_amount,SUM(dAmount) as t_d_amount,SUM(cAmount) as t_c_amount
        FROM acc_transactions t
        INNER JOIN acc_transaction_details on t.id = accTransId
        INNER JOIN chart_of_accounts c on c.id = chartOfAccId
        inner join chart_of_accounts p on p.id = c.parentId
        Where t.companyId =  $companyId and c.parentId = ".$ledgerId." AND t.date BETWEEN '". $fromDate ."' and '". $toDate ."'
        GROUP BY c.accHead ) as M GROUP BY accHead");
    }
}