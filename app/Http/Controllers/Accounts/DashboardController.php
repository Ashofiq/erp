<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Accounts\Transaction\AccTransaction\AccTransactionInterface;
use App\Repositories\Settings\Company\CompanyInterface;
use Route;

class DashboardController extends Controller
{
    public function __construct(
        AccTransactionInterface $accTransaction,         
        CompanyInterface $company
    ){   
        $this->company = $company;
        $this->accTransaction = $accTransaction;
        $this->middleware('auth');
    }

    public function index()
    {   
        $defaultCompanyId = $this->company->getUserDefaultCompanyId();
        $data['summary'] = $this->accTransaction->getLiquidCash($defaultCompanyId, $fromDate = date('Y-m-3'), $toDate = date('Y-m-d'));
        return view('Accounts.dashboard.index', $data);
    }
}
