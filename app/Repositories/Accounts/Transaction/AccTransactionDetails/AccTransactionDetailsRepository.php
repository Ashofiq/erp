<?php

namespace App\Repositories\Accounts\Transaction\AccTransactionDetails;

use App\Repositories\Accounts\Transaction\AccTransactionDetails\AccTransactionDetailsInterface as AccTransactionDetailsInterface;
use App\Models\Accounts\Transaction\AccTransactionDetails;
use Config;
use DB;

class AccTransactionDetailsRepository implements AccTransactionDetailsInterface
{
    public $accTransactionDetails;
    private $pagelimit;

    function __construct(AccTransactionDetails $accTransactionDetails) {
	    $this->accTransactionDetails = $accTransactionDetails;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }


    public function create($request){

        foreach ($request->accHead as $key => $value) {
            $accDetails = new  $this->accTransactionDetails;
            $accDetails->accTransId = $request->accTransId;
            $accDetails->dAmount = $request->dAmount[$key];
            $accDetails->cAmount = $request->cAmount[$key];
            $accDetails->chartOfAccId = $request->accHead[$key];
            $accDetails->accInvoiceNo = null;
            $accDetails->description = $request->description[$key];
            $accDetails->save();
        }

       
        return true;
    }

    public function update($id, $request){
        $this->accTransactionDetails->where('accTransId', $request->accTransId)->delete();
        foreach ($request->accHead as $key => $value) {
            $accDetails = new $this->accTransactionDetails;
            $accDetails->accTransId = $request->accTransId;
            $accDetails->dAmount = $request->dAmount[$key];
            $accDetails->cAmount = $request->cAmount[$key];
            $accDetails->chartOfAccId = $request->accHead[$key];
            $accDetails->accInvoiceNo = null;
            $accDetails->description = $request->description[$key];
            $accDetails->save();
        }

        return true;
    }

    public function exist($id){
        $data = $this->accTransactionDetails->where('chartOfAccId',$id)->first();
        if ($data != null) {
            return true;
        }
        return false;
    }
}