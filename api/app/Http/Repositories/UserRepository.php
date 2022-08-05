<?php

namespace App\Http\Repositories;

use App\Http\conf\Repository;
use App\Http\Repositories\ModelHelpers\AuthenticateUserModelHelpers;
use App\Models\Subscription;
use App\Models\User;
use Database\Factories\UserInfoFactory;
use Illuminate\Support\Facades\DB;
use function response;

class UserRepository extends Repository
{

    public static function find($id)
    {
        return User::all()->find($id);
    }

    public static function findWithInfos($id)
    {
        return User::all()->load('role','infos', 'keywords')->find($id);
    }

    public static function findWithSubs($id)
    {
        return User::all()->find($id)->load('subscriptions.key','invoices.paymentMethod');
    }


    public static function getAll()
    {
        return User::all();
    }

    public static function add($Model)
    {
        // TODO: Implement add() method.
    }

    public static function remove($id)
    {
        // TODO: Implement remove() method.
    }

    public static function set($model)
    {
        // TODO: Implement set() method.
    }

    public static function saveOrUpdate($model)
    {
        // TODO: Implement saveOrUpdate() method.
    }

    //
    public static function getAllUsersFull()
    {

        DB::enableQueryLog();
        $users = User::with(["role", "infos", "keywords", "keywords.type", "subscriptions", "subscriptions.key", "subscriptions.type"])->get()//->where('users.id','=',1)
        ;
        // dd(DB::getQueryLog());
        return [$users, DB::getQueryLog()];

    }

    public static function createFakeUser()
    {

        return response()->json(Subscription::factory(1)->create());
//        $userFactory = new UserFactory();
//
//        $user = $userFactory->create();
//
//        self::createFakeUserInfos($user);
//        // create user infos
//
//        return response()->json(User::all()->load(['infos','role', 'subscriptions'])->where());


    }

    public static function createFakeUserInfos($user)
    {
        $userInfosFactory = new UserInfoFactory();
        $userInfosFactory->create(['user_id' => $user->id]);
    }

    public static function connectUser($inputs)
    {
        return new AuthenticateUserModelHelpers($inputs);
    }


}
