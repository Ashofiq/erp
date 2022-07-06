<?php

namespace App\Repositories\Settings\Company;

use App\Repositories\Settings\Company\CompanyInterface as CompanyInterface;
use App\Models\Settings\Company\Company;
use Config;

class CompanyRepository implements CompanyInterface
{
    public $company;
    private $pagelimit;

    function __construct(Company $company) {
	    $this->company = $company;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function all()
    {   
        return $this->company->get();
    }

    public function userCompany(){
        return $this->company->get();
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