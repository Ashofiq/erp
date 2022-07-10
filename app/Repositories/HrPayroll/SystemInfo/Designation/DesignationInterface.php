<?php 

namespace App\Repositories\HrPayroll\SystemInfo\Designation;

interface DesignationInterface {

    public function getAll();

    public function saveDesignation($data);

    public function updateDesignation($data);

    public function deleteDesignation($id);

    public function exist($id);

    // public function getByParentId($parentId);

    // public function getById($parentId);
    
}