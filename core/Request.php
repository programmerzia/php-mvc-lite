<?php

namespace app\core;

class Request
{
    public function __construct()
    {

    }
    public function getPath(){
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($_SERVER['REQUEST_URI'], '?') ;

        if ($position === false){
            return $path;
        }
        return substr($_SERVER['REQUEST_URI'],0,$position);
    }
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}