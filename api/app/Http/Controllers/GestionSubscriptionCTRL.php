<?php

namespace App\Http\Controllers;

use App\Http\conf\Controller;
use App\Http\Repositories\SubscriptionRepository;
use App\Models\ApiKey;
use Illuminate\Http\Request;

class GestionSubscriptionCTRL extends Controller
{
    public static function fecth_user_aki_key(){
        $keys = ApiKey::all();

        return self::jsonResponse(['userKeys' => $keys]);

    }

    public static function create_new_subscriptions(Request $resquest){
        return self::jsonResponse(SubscriptionRepository::createSubscriptions($resquest->get('test')));
    }
}
