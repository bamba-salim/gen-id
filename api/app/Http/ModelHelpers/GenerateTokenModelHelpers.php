<?php

namespace App\Http\ModelHelpers;

use App\Http\Bean\Token;
use App\Http\Bean\TokenLogs;
use App\Http\conf\ModelHelpers;

class GenerateTokenModelHelpers extends ModelHelpers
{
    public TokenLogs $logs;

    /** @var Token $inputs */
    function __construct($inputs)
    {
        $this->inputs = $inputs;
        $this->logs = $inputs->getLogs();
        $this->execute();
    }

    function execute()
    {

        $this->results = match ($this->inputs->getType()) {
            'sku' => self::generateSKU($this->inputs),
            'serial' => self::generateSerial($this->inputs),
            'uid' => self::generateUID($this->inputs),
        };
    }


    private static function guidv4($data = null)
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

    private static function generateUID(Token $options)
    {

        return bin2hex(random_bytes($options->getSize() / 2));
    }

    private static function generateSerial(Token $options)
    {
        $finalArray = [];
        if (!empty($options->getPrefix())) $finalArray[] = $options->getPrefix();
        for ($i = 1; $i <= $options->getSize(); $i++) {
            $finalArray[] = self::createRandomHex(4);
        }
        if (!empty($options->getSuffix())) $finalArray[] = $options->getSuffix();
        return ["serial" => join($options->getSeparator(), $finalArray), "time" => time(), "date" => self::createDateTime()];
    }

    private static function generateSKU(Token $options)
    {

        return "XXXX/XXXX/XXXX";
    }


    private static function createDateTime()
    {
        return date('yWz-B', time());
    }

    private static function createRandomHex($size)
    {

        return bin2hex(random_bytes($size / 2));
    }



}
