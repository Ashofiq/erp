<?php

namespace App\Repositories\Settings\Company;

use App\Repositories\Settings\Company\CompanyInterface as CompanyInterface;
use App\Models\Settings\Company\Company;
use Config;
use Auth;

class CompanyRepository implements CompanyInterface
{
    public $company;
    private $pagelimit, $userId;


    function __construct(Company $company) {
	    $this->company = $company;
        $this->pagelimit = Config::get('app.PAGELIMIT');
        $this->userId = Auth::id();
    }

    public function all()
    {   
        return $this->company->get();
    }

    public function userCompany(){
        return $this->company
            ->join('company_assigns', function($query){
                $query->on('companies.id', '=', 'company_assigns.companyId');
                $query->where('userId', Auth::id());
            })
            ->select('companies.id as id', 'companies.name as name')
            ->get();
    }

    public function allCompany()
    {
        return $this->company->paginate($this->pagelimit);
    }

    public function saveCompany($data)
    {
        $this->company->name = $data->name;
        $this->company->description = $data->description;
        $this->company->address = $data->address;
        $this->company->lavel = $data->lavel;
        return $this->company->save();
    }

    public function latestOne()
    {
        return $this->company->latest()->first();
    }

    public function getUserDefaultCompanyId(){
        return 1;
    }
}