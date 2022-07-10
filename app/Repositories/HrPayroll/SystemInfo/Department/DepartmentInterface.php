<?php 

namespace App\Repositories\HrPayroll\SystemInfo\Department;

interface DepartmentInterface {

    public function getAll();

    public function saveDepartment($data);

    public function updateDepartment($data);

    public function deleteDepartment($id);

    public function exist($id);

    // public function getByParentId($parentId);

    // public function getById($parentId);
    
}