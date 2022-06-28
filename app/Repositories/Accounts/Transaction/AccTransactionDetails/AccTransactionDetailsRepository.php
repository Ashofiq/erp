<?php

namespace App\Repositories\Accounts\Transaction\AccTransactionDetails;

use App\Repositories\Accounts\Transaction\AccTransactionDetails\AccTransactionDetailsInterface as AccTransactionDetailsInterface;
use App\Models\Accounts\Transaction\AccTransactionDetails;
use Config;

class AccTransactionDetailsRepository implements AccTransactionDetailsInterface
{
    public $accTransactionDetails;
    private $pagelimit;

    function __construct(AccTransactionDetails $accTransactionDetails) {
	    $this->accTransactionDetails = $accTransactionDetails;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }



}