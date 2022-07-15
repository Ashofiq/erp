<?php

namespace App\Repositories\HrPayroll\Employee;

use App\Repositories\HrPayroll\Employee\EmployeeInterface as EmployeeInterface;
use App\Models\HrPayroll\Employee\Employee;
use Config;

class EmployeeRepository implements EmployeeInterface
{
    public $employee;
    private $pagelimit;
    
    function __construct(Employee $employee) {
	    $this->employee = $employee;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function getAll()
    {
        return $this->employee->get();
    }
    
    // public function saveDepartment($data)
    // {
    //     $this->employee->name = $data->name;
    //     $this->employee->description = $data->description;
    //     $this->employee->lavel = $this->genLavel();
    //     $this->employee->status = $this->employee::ACTIVE;
    //     $employee = $this->employee->save();
    //     if ($employee) {
    //         return $this->employee;
    //     }
    //     return false;
    // }

    // public function updateDepartment($data){
    //     $department = $this->department->find($data->id);

    //     $department->name = $data->name;
    //     $department->description = $data->description;
    //     if ($department->save()) {
    //         return $department;
    //     }
    //     return false;
    // }

    // public function deleteDepartment($id)
    // {   
    //     $department = $this->department->find($id);
    //     if ($department->delete()) {
    //         return true;
    //     }

    //     return false;
    // }
    // public function genLavel()
    // {
    //     return $this->department->latest()->first()?->lavel + 1;
    // }

    // public function exist($id){
    //     return false;
    // }

}