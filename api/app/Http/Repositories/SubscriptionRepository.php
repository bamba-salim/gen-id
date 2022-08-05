<?php

namespace App\Http\Repositories;

use App\Http\Repositories\ModelHelpers\CreateSubscriptionModelHelpers;
use App\Models\ApiKey;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Throwable;
use function dd;

class SubscriptionRepository
{
    public static function createSubscriptions($inputs)
    {
        return new CreateSubscriptionModelHelpers($inputs);
    }


    /**
     * @param String $key
     * @return Collection
     */
    public static function getSubsByApiKey(string $key): Collection
    {
        return Subscription::all()->load(['key', 'user'])->where('key.key', '=', "$key");
    }


    /**
     * @param string $token
     * @return null|User
     */
    public static function getUserByApiKey(string $token): ?User
    {
        try {
            $api = ApiKey::with('subscriptions', 'subscriptions.user')->where('key', $token);
            return $api->get()->first()->subscriptions->first()->user;
        } catch (Throwable $exception) {
            return null;
        }

    }


}
