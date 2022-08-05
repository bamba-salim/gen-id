<?php


use App\Http\Controllers\GestionGeneratorCTRL;
use Illuminate\Support\Facades\Route;

Route::post("/v1/{type}", [GestionGeneratorCTRL::class, "generate"]);
Route::post("/v2/{type}", [GestionGeneratorCTRL::class, "generateV2"]);
