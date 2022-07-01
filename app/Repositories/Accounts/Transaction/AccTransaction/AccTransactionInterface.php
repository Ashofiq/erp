<?php 

namespace App\Repositories\Accounts\Transaction\AccTransaction;


interface AccTransactionInterface {
    public function get($transType);

    public function create($request);

    public function update($id, $request);

    public function delete($request);

    public function getById($id);

    public function getType($typeNo);

    public function getTypeNo($transType);

    public function getTitle($typeNo);

    public function acchead($transTypeNo, $companyId);

}