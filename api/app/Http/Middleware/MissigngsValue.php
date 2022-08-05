<?php

namespace App\Http\Middleware;

use App\Http\conf\Controller;
use Closure;
use Illuminate\Http\Request;

class MissigngsValue
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, String $key)
    {
        if($request->get($key) == null) return Controller::jsonResponse(["message" => "[$key] is missing !"], 202);
        return $next($request);
    }


}
