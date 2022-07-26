<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckApiKeyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('api-user-token');
        $apiToken = $request->get('key');

        // todo: check if api key exist

        // todo check if api key can works

        if($token != null || $apiToken != null){
            return $next($request);
        }else{
            return new JsonResponse(["message"=> "invalid token"],403);
        }
    }
}
