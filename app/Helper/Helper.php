<?php

namespace App\Helper;

class Helper {
    
    public function upper($string) : String
    {
        return strtoupper($string);
    }

    public static function dateEnToBn($date)
    {
        return date('d-m-Y', strtotime($date));
    }

    public static function dateBnToEn($date) 
    {   
        return date('Y-m-d', strtotime($date));
    }
}
