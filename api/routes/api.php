<?php

use App\Http\Controllers\generator\GestionGeneratorCTRL;
use App\Http\Controllers\site\GestionArtisanCTRL;
use App\Http\Middleware\AutorizeArtisanValid;
use App\Http\Middleware\CheckApiKeyToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('artisan')->middleware(AutorizeArtisanValid::class)->group(function () {
    Route::get("/migrate", [GestionArtisanCTRL::class, 'migrate']);
    Route::get("/migrate-reset", [GestionArtisanCTRL::class, 'reset']);
    Route::get("/migrate-refresh", [GestionArtisanCTRL::class, 'refresh']);
    Route::get('/clear', [GestionArtisanCTRL::class, 'clear']);
});


