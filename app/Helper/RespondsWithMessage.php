<?php

namespace App\Helper;

trait RespondsWithMessage
{   
    
    protected function response($class, $message) : array
    {
        return array(
            'class' => $class,
            'message' => $message
        );
    }

    public function ajaxResponse($class, $message, $data){
        return (object) array(
            'class' => $class,
            'message' => $message,
            'data'    => $data
        );
    }

    public function SUCCESSCLASS() : String
    {
        return 'success';
    }

    public function FAILURECLASS() : String
    {
        return 'error';
    }

    public function SUCCESSMESSAGE() : String
    {
        return 'Successfully added';
    }

    public function FAILMESSAGE() : String
    {
        return 'Successfully added';
    }
} 