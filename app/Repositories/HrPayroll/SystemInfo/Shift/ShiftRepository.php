<?php

namespace App\Repositories\HrPayroll\SystemInfo\Shift;

use App\Repositories\HrPayroll\SystemInfo\Shift\ShiftInterface as ShiftInterface;
use App\Models\HrPayroll\SystemInfo\Shift;
use Config;

class ShiftRepository implements ShiftInterface
{
    public $shift;
    private $pagelimit;
    
    function __construct(Shift $shift) {
	    $this->shift = $shift;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function getAll()
    {
        return $this->shift->get();
    }
    
    public function saveShift($data)
    {
        $this->shift->name = $data->name;
        $this->shift->description = $data->description;
        $this->shift->lavel = $this->genLavel();
        $this->shift->status = $this->shift::ACTIVE;
        $shift = $this->shift->save();
        if ($shift) {
            return $this->shift;
        }
        return false;
    }

    public function updateShift($data){
        $shift = $this->shift->find($data->id);

        $shift->name = $data->name;
        $shift->description = $data->description;
        if ($shift->save()) {
            return $shift;
        }
        return false;
    }

    public function deleteShift($id)
    {   
        $shift = $this->shift->find($id);
        if ($shift->delete()) {
            return true;
        }

        return false;
    }
    public function genLavel()
    {
        return $this->shift->latest()->first()?->lavel + 1;
    }

    public function exist($id){
        // $data = $this->designation->find($id);
        // if ($data != null) {
        //     return true;
        // }
        return false;
    }

}