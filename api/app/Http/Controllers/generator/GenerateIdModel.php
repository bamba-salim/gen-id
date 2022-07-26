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

    public static function generateID($type, $inputsOptions)
    {
        $options = OptionsGeneratorDTO::build($inputsOptions, $type);
        return match ($type) {
            'sku' => self::generateSKU($options),
            'serial' => self::generateSerial($options),
            'uid' => self::generateUID($options),
        };

    }

    public static function generateIDV2($type, $inputsOptions)
    {
        $options = OptionsGeneratorDTO::buildV2($inputsOptions, $type);
        return match ($type) {
            'sku' => self::generateSKU($options),
            'serial' => self::generateSerial($options),
            'uid' => self::generateUID($options),
        };

    }

    protected static function generateUID(OptionsGeneratorDTO $options)
    {

        return bin2hex(random_bytes($options->getSize() / 2));
    }

    protected static function generateSerial(OptionsGeneratorDTO $options)
    {
        $finalArray = [];
        if (!empty($options->getPrefixe())) $finalArray[] = $options->getPrefixe();
        for ($i = 1; $i <= $options->getSize(); $i++) {
            $finalArray[] = self::createRandomHex(4);
        }
        if (!empty($options->getSuffixe())) $finalArray[] = $options->getSuffixe();
        return ["serial" => join("-", $finalArray), "time" => time(), "date" => self::createDateTime()];
    }

    protected static function generateSKU(OptionsGeneratorDTO $options)
    {

        return "XXXX/XXXX/XXXX";
    }

    protected static function guidv4($data = null)
    {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    protected static function createDateTime(){
        return date('yWz-B', time());
    }

    protected static function createRandomHex($size){

        return bin2hex(random_bytes($size/2));
    }

}

