<?php 

namespace App\Repositories\HrPayroll\Employee;

interface EmployeeInterface {

    public function getAll();
    public function saveEmployee($data);

    // public function saveDepartment($data);

    // public function updateDepartment($data);

    // public function deleteDepartment($id);

    // public function exist($id);
    
}