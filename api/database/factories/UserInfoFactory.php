<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInfo>
 */
class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::all("id")->random(1)->first();
        return [
            "user_id" => $user->id,
            "firstname" => fake()->firstName(),
            "lastname" => fake()->lastName(),
            "adresse" => fake()->streetAddress(),
            'zip_code' => intval(fake()->postcode()),
            'city' => fake()->city(),
            'country' => fake()->country(),
            "phone_number_1" => intval(fake()->phoneNumber())
        ];
    }
}
