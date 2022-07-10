<?php

namespace App\Repositories\HrPayroll\SystemInfo\Designation;

use App\Repositories\HrPayroll\SystemInfo\Designation\DesignationInterface as DesignationInterface;
use App\Models\HrPayroll\SystemInfo\Designation;
use Config;

class DesignationRepository implements DesignationInterface
{
    public $designation;
    private $pagelimit;
    
    function __construct(Designation $designation) {
	    $this->designation = $designation;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function getAll()
    {
        return $this->designation->get();
    }
    
    public function saveDesignation($data)
    {
        $this->designation->name = $data->name;
        $this->designation->description = $data->description;
        $this->designation->lavel = $this->genLavel();
        $this->designation->status = $this->designation::ACTIVE;
        $designation = $this->designation->save();
        if ($designation) {
            return $this->designation;
        }
        return false;
    }

    public function updateDesignation($data){
        $designation = $this->designation->find($data->id);

        $designation->name = $data->name;
        $designation->description = $data->description;
        if ($designation->save()) {
            return $designation;
        }
        return false;
    }

    public function deleteDesignation($id)
    {   
        $designation = $this->designation->find($id);
        if ($designation->delete()) {
            return true;
        }

        return false;
    }
    public function genLavel()
    {
        return $this->designation->latest()->first()?->lavel + 1;
    }

    public function exist($id){
        // $data = $this->designation->find($id);
        // if ($data != null) {
        //     return true;
        // }
        return false;
    }

}