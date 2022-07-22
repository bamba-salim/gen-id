<?php

namespace App\Http\Controllers\generator;


use App\Http\Controllers\generator\DTO\OptionsGeneratorDTO;
use App\Http\Utils\DataBaseConstants;
use Throwable;

class GenerateIdModel
{

    private const TYPE_SIZE = [
        ""
    ];

    public static function generateID($type, $options)
    {
        $options = OptionsGeneratorDTO::build($options, $type);
        dd($options);
        return match ($type) {
            'sku' => self::generateSKU($options),
            'serial' => self::generateSerial($options),
            'uid' => self::generateUID($options, $type),
        };

    }

    protected static function generateUID($options, $type)
    {

        $size = self::matchSize($options, $type);


        dd($size);
        return bin2hex(random_bytes(3));
    }

    protected static function generateSerial($options)
    {
        return "XXXX-XXXX-XXXX";
    }

    protected static function generateSKU($options)
    {

        return "XXXX/XXXX/XXXX";
    }



}

