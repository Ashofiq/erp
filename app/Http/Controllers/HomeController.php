<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Accounts\Transaction\AccTransaction\AccTransactionInterface;
use App\Repositories\Settings\Company\CompanyInterface;

class HomeController extends Controller
{   
    private $accTransaction, $company;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        AccTransactionInterface $accTransaction,         
        CompanyInterface $company
    ){   
        $this->company = $company;
        $this->accTransaction = $accTransaction;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $defaultCompanyId = $this->company->getUserDefaultCompanyId();
        $data['summary'] = $this->accTransaction->getLiquidCash($defaultCompanyId, $fromDate = date('Y-m-3'), $toDate = date('Y-m-d'));
        return view('Accounts.dashboard.index', $data);
    }
}
