<?php

use App\Http\Utils\DateUtils;
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
        Schema::create('user_keyword_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('user_keywords', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('user_keyword_type_id')->constrained();
            $table->string('name');
        });
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
        });

        Schema::create('subscription_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('longer');
            $table->integer('limit');
        });


        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('api_key_id')->constrained();
            $table->dateTime('date_debut')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('date_fin')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('limit')->default(0);
            $table->integer('calls')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });


        DB::table('subscription_types')
            ->insert([
                ["name" => "7 days free (20 call)", 'longer' => 7, 'limit' => 20]
            ]);

        DB::table('user_keyword_types')
            ->insert([
                ["id" => 1, "name" => "prefix"],
                ["id" => 2, "name" => "suffix"]
            ]);

        DB::table('api_keys')
            ->insert([
                ["id" => 1, "key" => "8f7097b47a9f3a5e-b40905c39fe8903e-774e056353193794-b7d929e9ea853bb3"], // admin key
                ["id" => 2, "key" => "e23ea2a98f3834b1-90e91e1954714417-29ffbbed70ba3659-b53047bc9be238b5"] // user key
            ]);
        $date_debut = DateUtils::date_now()->format(DateUtils::FORMAT_YYYY_MM_DD);
        $date_fin = DateUtils::addDays($date_debut, DateUtils::FORMAT_YYYY_MM_DD,356)->format(DateUtils::FORMAT_YYYY_MM_DD);

        DB::table('subscriptions')
            ->insert([
                [
                    "user_id" => 1,
                    "api_key_id" => 1,
                    "limit" => 0,
                    "calls" => 0,
                    "date_debut" => $date_debut,
                    "date_fin" => $date_fin
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
        Schema::dropIfExists('user_keywords');
        Schema::dropIfExists('user_keyword_types');
        Schema::dropIfExists('subscription_subscription_types');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('api_keys');
        Schema::dropIfExists('subscription_types');
    }
};
