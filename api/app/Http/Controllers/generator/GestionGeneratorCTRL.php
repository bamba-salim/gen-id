<?php

namespace App\Http\Controllers\generator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GestionGeneratorCTRL extends Controller
{
    public static function generate(Request $request, string $type, string $key = null)
    {

        //dd($key);
        $options = json_decode($request->get('options'));
        return response()->json(GenerateIdModel::generateID($type, $options));


    }

    public static function generateV2(Request $request, string $type, string $key = null)
    {

        $options = json_decode($request->get("options"));
        return response()->json(GenerateIdModel::generateIDV2($type, $options));
    }
}
