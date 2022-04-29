<?php

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

use App\Api\Auth\Controllers\{LoginController, LogoutController, RegisterController};
use App\Api\Category\Controllers\CategoryController;
use App\Api\Product\Controllers\ProductController;
use App\Api\Role\Controllers\RoleController;
use App\Api\User\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('json.response')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);

    Route::middleware(['auth:sanctum', 'check.roles'])->group(function () {
        Route::delete('logout', LogoutController::class);

        Route::apiResources([
            'users'      => UserController::class,
            'roles'      => RoleController::class,
            'categories' => CategoryController::class,
            'products'   => ProductController::class,
        ]);
    });
});
