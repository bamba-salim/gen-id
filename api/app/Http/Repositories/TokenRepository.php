<?php

namespace App\Http\Repositories;


use App\Http\Bean\Token;
use App\Http\ModelHelpers\GenerateTokenModelHelpers;

class TokenRepository
{


    public static function generateID(Token $token)
    {
        return new GenerateTokenModelHelpers($token);
    }


    public static function generateApiKey()
    {
        $final = "";
        for ($i = 1; $i <= 2; $i++) $final = $final . str_replace('-','',fake()->uuid());

        return join('-',str_split($final,16));
    }


}

