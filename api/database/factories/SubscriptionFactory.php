<?php

namespace Database\Factories;

use App\Http\Utils\DateUtils;
use App\Models\ApiKey;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::all('id')->random(1)->first();
        $key = ApiKey::all('id')->random(1)->first();

        $date_debut = DateUtils::date_now();
        $date_fin = DateUtils::addDays($date_debut, DateUtils::FORMAT_YYYY_MM_DD,fake()->randomElement([356,180,7,14,30,60,90]))->format(DateUtils::FORMAT_YYYY_MM_DD);
        return [
            "user_id" => $user->id,
            "api_key_id" => $key->id,
            "limit" => fake()->randomElement([0,20]),
            "calls" => fake()->numberBetween(0,20),
            "date_debut" => $date_debut,
            "date_fin" => $date_fin
        ];
    }
}
