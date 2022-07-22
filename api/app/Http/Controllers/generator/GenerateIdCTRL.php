<?php

namespace App\Http\Controllers\generator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerateIdCTRL extends Controller
{
    public static function generate(Request $request, string $type)
    {
        $generateBean = json_decode($request->input('option'));


        dd("generate => $type",GenerateIdModel::generateID($type, $generateBean));
    }

}
