<?php

namespace App\Helper;

class Helper {
    
    public function upper($string) : String
    {
        return strtoupper($string);
    }

    public function dateEnToBn($date)
    {
        return date('d-m-Y', strtotime($date));
    }

    public function dateBnToEn($date) 
    {
        return date('Y-m-d', strtotime($date));
    }
}
