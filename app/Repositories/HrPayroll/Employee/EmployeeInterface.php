<?php 

namespace App\Repositories\HrPayroll\Employee;

interface EmployeeInterface {

    public function getAll();

    public function saveEmployee($data);

    
}