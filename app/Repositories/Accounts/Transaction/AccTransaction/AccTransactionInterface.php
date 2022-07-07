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

    public function transTypes();

    public function getVoucherList($companyId, $transType, $fromDate, $toDate);

    public function getBankData($companyId, $fromDate);

    public function getCashData($companyId, $fromDate);

    public function getOpeningValueWithAccHead($companyId, $fromDate, $ledgerId);

    public function getSubLedger($companyId, $fromDate, $toDate, $ledgerId);

    public function controlWiseLedger($companyId);

    public function getControlSubLedger($companyId, $fromDate, $toDate, $ledgerId);
}