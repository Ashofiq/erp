<?php

namespace App\Repositories\Settings\Company;

use App\Repositories\Settings\Company\CompanyInterface as CompanyInterface;
use App\Models\Settings\Company\Company;
use App\Models\Settings\CompanyAssign\CompanyAssign;
use Config;
use Auth;

class CompanyRepository implements CompanyInterface
{
    public $company, $companyAssign;
    private $pagelimit, $userId;

    function __construct(Company $company, CompanyAssign $companyAssign) {
	    $this->company = $company;
        $this->pagelimit = Config::get('app.PAGELIMIT');
        $this->userId = Auth::id();
        $this->companyAssign = $companyAssign;
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
        return $this->companyAssign->where('userId', Auth::id())->where('default', 1)->first()?->companyId;
    }

    public function getById($id){
        return $this->company->find($id);
    }
}