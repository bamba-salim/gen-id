<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');

        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->default(2)->constrained();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string("firstname");
            $table->string("lastname");
            $table->mediumText('adresse');
            $table->string("zip_code");
            $table->string('city');
            $table->string('country');
            $table->string('phone_number_1');
            $table->string('phone_number_2')->nullable();
            $table->timestamps();
        });


        DB::table('roles')
            ->insert([
                ['id' => 1, 'name' => 'admin'],
                ['id' => 2, 'name' => 'user']
            ]);

        DB::table('users')
            ->insert([
                [
                    "id" => 1,
                    'username' => "admin",
                    'role_id' => 1,
                    'email' => "admin@" . env('APP_NAME') . ".com",
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ],
                [
                    "id" => 2,
                    'username' => "user",
                    'role_id' => 2,
                    'email' => "user@" . env('APP_NAME') . ".com",
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ]
            ]);

        DB::table('user_infos')
            ->insert([
                [
                    "user_id" => 2,
                    "firstname" => "user",
                    "lastname" => "USER",
                    "adresse" => fake()->streetAddress(),
                    'zip_code' => fake()->postcode(),
                    'city' => fake()->city(),
                    'country' => fake()->country(),
                    "phone_number_1" => fake()->phoneNumber(),
                    "phone_number_2" => fake()->phoneNumber(),
                ]
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};
