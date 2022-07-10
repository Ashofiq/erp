<?php 

namespace App\Repositories\HrPayroll\SystemInfo\Shift;

interface ShiftInterface {

    public function getAll();

    public function saveShift($data);

    public function updateShift($data);

    public function deleteShift($id);

    public function exist($id);
}