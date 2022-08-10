<?php
namespace App\Enum;

abstract class Enumeration
{
    public static function enum() 
    {
        $reflect = new \ReflectionClass( get_called_class() );
        return $reflect->getConstants();
    }
}