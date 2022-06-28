<?php

namespace App\Repositories\Accounts\FinancialYear;

use App\Repositories\Accounts\FinancialYear\FinancialYearInterface as FinancialYearInterface;
use App\Models\Accounts\FinancialYear\FinancialYear;
use Config;

class FinancialYearRepository implements FinancialYearInterface
{
    public $fiscalYear;
    private $pagelimit;

    function __construct(FinancialYear $fiscalYear) {
	    $this->fiscalYear = $fiscalYear;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }


    public function active(){
        return $this->fiscalYear->where('status', 1)->first();
    }

    public function allFinancialYear()
    {
        return $this->fiscalYear->paginate($this->pagelimit);
    }

    public function saveFinancialYear($data)
    {
        $this->fiscalYear->fromDate = $data->fromDate;
        $this->fiscalYear->toDate = $data->toDate;
        $this->fiscalYear->companyId = $data->companyId;
        $this->fiscalYear->status = $data->status;
        $this->fiscalYear->serial = $data->serial;
        return $this->fiscalYear->save();
    }

    

    public function latestOne()
    {
        return $this->fiscalYear->latest()->first();
    }

    public function all()
    {
        return $this->fiscalYear->with('company')->orderBy('id', 'DESC')->paginate($this->pagelimit);
    }

    public function checkAndDeactive($companyId)
    {
        $company = $this->fiscalYear->where('companyId', $companyId)
                                ->where('status', 1)->first();
        if ($company != null) {
            $company->status = 0;
            $company->save();
            return true;
        }

        return false;
    }

}