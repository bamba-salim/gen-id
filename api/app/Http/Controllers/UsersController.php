<?php

namespace App\Http\Controllers;

use App\Http\Bean\Error;
use App\Http\conf\Controller;
use App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public static function fetchRoles()
    {
        return self::jsonResponse(['users' => UserRepository::getAllUsersFull()]);
    }

    public static function signInUser(Request $request)
    {

        $final = UserRepository::connectUser($request->get('loginFormBean'))->results;

        if(self::res_is_error($final)) {
           /** @var Error $final */
            return $final->throw_json();
        } else {
            return self::jsonResponse(["user" => $final]);
        }
    }
}
