<?php

namespace App\Repositories\Accounts\Transaction\AccTransaction;

use App\Repositories\Accounts\Transaction\AccTransaction\AccTransactionInterface as AccTransactionInterface;
use App\Models\Accounts\Transaction\AccTransaction;
use Config;
use App\Enum\TransactionList;
use App\Enum\TransactionType;
use App\Enum\TransactionTitle;
use DB;

class AccTransactionRepository implements AccTransactionInterface
{
    public $accTransaction;
    private $pagelimit;

    function __construct(AccTransaction $accTransaction) {
	    $this->accTransaction = $accTransaction;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function create($data){
        return $data;
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


    public function acchead($transTypeNo, $companyId)
    {
        $sql = "select * from `chart_of_accounts`
        where `companyId` = $companyId and `id` not in (select `parentId` from `chart_of_accounts`)
        Order By accHead asc";
        return DB::select($sql);
    }
}