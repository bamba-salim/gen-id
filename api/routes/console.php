<?php

use App\Http\Controllers\GestionArtisanCTRL;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/


Route::controller(GestionArtisanCTRL::class)->group(function(){

    Route::get('/clear', 'clear');

    Route::prefix('migrate')->group(function (){
        Route::get("/", 'migrate');
        Route::get("reset", 'reset');
        Route::get("force-reset", 'force_reset');
        Route::get("refresh", 'refresh');
    });

});


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
