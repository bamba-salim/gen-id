<?php

use App\Http\Controllers\generator\GenerateIdCTRL;
use App\Http\Controllers\generator\Serialcontroller;
use App\Http\Controllers\generator\SKUcontroller;
use App\Http\Controllers\generator\UIDcontroller;
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

Route::prefix('gen')->middleware(CheckApiKeyToken::class)->group(function () {
    Route::post("/v1/{type}", [GenerateIdCTRL::class, "generate"]);
});
