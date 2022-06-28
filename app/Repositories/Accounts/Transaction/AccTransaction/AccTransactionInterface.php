<?php 

namespace App\Repositories\Accounts\Transaction\AccTransaction;


interface AccTransactionInterface {
    public function create($data);

    public function getType($typeNo);

    public function getTitle($typeNo);

    public function acchead($transTypeNo, $companyId);

}