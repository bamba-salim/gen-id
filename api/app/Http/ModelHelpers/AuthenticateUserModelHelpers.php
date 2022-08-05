<?php

namespace App\Http\Repositories\ModelHelpers;

use App\Http\Bean\Error;
use App\Http\conf\ModelHelpers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticateUserModelHelpers extends ModelHelpers
{
    public function __construct($inputs)
    {

        $this->inputs = (object) $inputs;
        $this->execute();

    }

    function execute()
    {
        $user = $this->findByEmailOrUsername($this->inputs->user);
        if ($user == null){
            $this->results = new Error(400, "[{$this->inputs->user}] cet utilisateur n'existe pas !");
        } else {
            if(!Hash::check($this->inputs->password, $user->password)) {
                $this->results = new Error(400, "Le mot de passe ne correspond pas !");
            } else {
                $this->results = $user;
            }
        }
    }

    /**
     * @param $userLogin
     * @return User|null
     */
    private function findByEmailOrUsername($userLogin): ?User
    {
        return User::with('role','infos')->where('username', '=', "$userLogin")->orWhere('email', '=', "$userLogin")->get()->first();

    }

}
