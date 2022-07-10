<?php

namespace App\Repositories\HrPayroll\SystemInfo\Department;

use App\Repositories\HrPayroll\SystemInfo\Department\DepartmentInterface as DepartmentInterface;
use App\Models\HrPayroll\SystemInfo\Department;
use Config;

class DepartmentRepository implements DepartmentInterface
{
    public $department;
    private $pagelimit;
    
    function __construct(Department $department) {
	    $this->department = $department;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function getAll()
    {
        return $this->department->get();
    }
    
    public function saveDepartment($data)
    {
        $this->department->name = $data->name;
        $this->department->description = $data->description;
        $this->department->lavel = $this->genLavel();
        $this->department->status = $this->department::ACTIVE;
        $department = $this->department->save();
        if ($department) {
            return $this->department;
        }
        return false;
    }

    public function updateDepartment($data){
        $department = $this->department->find($data->id);

        $department->name = $data->name;
        $department->description = $data->description;
        if ($department->save()) {
            return $department;
        }
        return false;
    }

    public function deleteDepartment($id)
    {   
        $department = $this->department->find($id);
        if ($department->delete()) {
            return true;
        }

        return false;
    }
    public function genLavel()
    {
        return $this->department->latest()->first()?->lavel + 1;
    }

    public function exist($id){
        // $data = $this->department->find($id);
        // if ($data != null) {
        //     return true;
        // }
        return false;
    }

}