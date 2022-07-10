<?php

namespace App\Repositories\HrPayroll\SystemInfo\Section;

use App\Repositories\HrPayroll\SystemInfo\Section\SectionInterface as SectionInterface;
use App\Models\HrPayroll\SystemInfo\Section;
use Config;

class SectionRepository implements SectionInterface
{
    public $section;
    private $pagelimit;
    
    function __construct(Section $section) {
	    $this->section = $section;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function getAll()
    {
        return $this->section->get();
    }
    
    public function saveSection($data)
    {
        $this->section->name = $data->name;
        $this->section->description = $data->description;
        $this->section->lavel = $this->genLavel();
        $this->section->status = $this->section::ACTIVE;
        $section = $this->section->save();
        if ($section) {
            return $this->section;
        }
        return false;
    }

    public function updateSection($data){
        $section = $this->section->find($data->id);

        $section->name = $data->name;
        $section->description = $data->description;
        if ($section->save()) {
            return $section;
        }
        return false;
    }

    public function deleteSection($id)
    {   
        $section = $this->section->find($id);
        if ($section->delete()) {
            return true;
        }

        return false;
    }
    public function genLavel()
    {
        return $this->section->latest()->first()?->lavel + 1;
    }

    public function exist($id){
        // $data = $this->section->find($id);
        // if ($data != null) {
        //     return true;
        // }
        return false;
    }

}