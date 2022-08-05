<?php

namespace App\Http\Middleware;

use App\Http\conf\Controller;
use App\Http\Repositories\SubscriptionRepository;
use App\Utils\DataBaseConstants;
use Closure;
use Illuminate\Http\Request;

class AutorizeArtisanValid
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $token = $request->header('api-user-token');
        if (empty($token)) return response()->json(["message" => "invalid token"], 403);
        $userSubs = SubscriptionRepository::getUserByApiKey($token);
        if ($userSubs == null || $userSubs->role_id != DataBaseConstants::USER_ROLE['ADMIN']) return Controller::jsonResponse(["message" => "Vous n'avez pas accès à cette fonctionalité !"], 403);
        return $next($request);
    }
}
