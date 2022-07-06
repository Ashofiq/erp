<?php

namespace App\Repositories\Settings\CompanyAssign;

use App\Repositories\Settings\CompanyAssign\CompanyAssignInterface as CompanyAssignInterface;
use App\Models\Settings\CompanyAssign\CompanyAssign;
use Config;
use Helper;

class CompanyAssignRepository implements CompanyAssignInterface
{
    public $companyAssign;
    private $pagelimit;

    function __construct(CompanyAssign $companyAssign) {
	    $this->companyAssign = $companyAssign;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }


    public function assign($data, $userId){
        $check = $this->companyAssign
                      ->where('companyId', $data->companyId)
                      ->where('userId', $userId)
                      ->first();
        if ($check != null) {
            $companyAssign = $this->companyAssign->find($check->id);
        }else{
            $companyAssign = new  $this->companyAssign;
        }
        
        $companyAssign->userId = $userId;
        $companyAssign->companyId = $data->companyId;
        $companyAssign->default = (isset($data->default)) ? $data->default == 'on' ? 1 : 0 : 1;
        return $companyAssign->save();

    }

    public function getAll(){
        return $this->companyAssign->query()
        ->join('companies', 'companies.id', '=', 'company_assigns.companyId')
        ->join('users', 'users.id', '=', 'userId')
        ->selectRaw('company_assigns.*, users.*, companies.name as companyName,
        companies.id as companyId, users.id as userId')
        ->paginate($this->pagelimit);
    }

    public function delete($data){
        $assignData = $this->companyAssign->where('companyId', $data->companyId)
                                          ->where('userId', $data->userId)
                                          ->first();
        if ($assignData != null) {
            $assignData->delete();
            return true;
        }
        return false;
    }

    public function update($data){
        $companyAssign = $this->companyAssign->find($data->id);

        $companyAssign->userId = $data->userId;
        $companyAssign->companyId = $data->companyId;
        $companyAssign->default = (isset($data->default)) ? $data->default == 'on' ? 1 : 0 : 1;
        if ($companyAssign->save()) {
            return true;
        }
        return false;
    }
}