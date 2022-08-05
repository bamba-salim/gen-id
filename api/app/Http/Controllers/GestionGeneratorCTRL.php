<?php

namespace App\Http\Controllers;

use App\Http\Bean\Token;
use App\Http\conf\Controller;
use App\Http\Repositories\SubscriptionRepository;
use App\Http\Repositories\TokenRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;
use stdClass;

class GestionGeneratorCTRL extends Controller
{
    public static function generate(Request $request, string $type)
    {
        return self::jsonResponse(TokenRepository::generateID(
            new Token(
                $type,
                SubscriptionRepository::getUserByApiKey($request->header('api-user-token')),
                (object)$request->get('options')
            )
        ));
    }

    public static function generateApiKey()
    {
        return self::jsonResponse(TokenRepository::generateApiKey());
    }

    public static function generateV2(Request $request, string $type)
    {
        $options = json_decode($request->get("options"));
        return self::jsonResponse(TokenRepository::generateIDV2($type, $options));
    }
}
