<?php

namespace App\Http\Utils;

class RouteUtils
{
    public static function JSON_UT8(){
        return ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'];
    }

}
