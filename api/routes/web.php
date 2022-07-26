<?php

use App\Http\Controllers\generator\GestionGeneratorCTRL;
use App\Http\Middleware\CheckApiKeyToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * GENERATOR CALL
 */
Route::prefix('gen')->middleware(CheckApiKeyToken::class)->group(function () {
    Route::get("v1/{type}", [GestionGeneratorCTRL::class, "generate"]);
    Route::get("v2/{type}", [GestionGeneratorCTRL::class, "generateV2"]);
});

/*
 * SITE CALL
 */
Route::prefix('ws')->group(function () {
    Route::get('user', function () {
        return response()->json(["user" => '54']);
    });
});
