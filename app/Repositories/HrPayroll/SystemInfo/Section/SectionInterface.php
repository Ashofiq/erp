<?php 

namespace App\Repositories\HrPayroll\SystemInfo\Section;

interface SectionInterface {

    public function getAll();

    public function saveSection($data);

    public function updateSection($data);

    public function deleteSection($id);

    public function exist($id);

    // public function getByParentId($parentId);

    // public function getById($parentId);
    
}