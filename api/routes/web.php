<?php

use App\Http\Controllers\GestionGeneratorCTRL;
use App\Http\Controllers\GestionSubscriptionCTRL;
use App\Http\Controllers\UsersController;
use App\Http\Repositories\UserRepository;
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
 * SITE CALL
 */
Route::get('users', [UsersController::class, 'fetchRoles']);
Route::post('sign-in', [UsersController::class, 'signInUser'])->middleware("missingArgs:loginFormBean");
Route::get('generate-user-api-key', [GestionGeneratorCTRL::class, 'generateApiKey']);
Route::post("create-new-subscription", [GestionSubscriptionCTRL::class, 'create_new_subscriptions']);

Route::prefix('fake')->group(function () {
    Route::get('create-user', [UserRepository::class, 'createFakeUser']);
});
