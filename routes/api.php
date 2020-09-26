<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\AuthController;

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

/*
 * Auth
 */
Route::group(['prefix' => 'auth',], function () {
    Route::post('login', [AuthController::class, 'login'])
        ->name('auth.login');
    Route::get('logout', [AuthController::class, 'logout'])
        ->name('auth.logout');
});

Route::group(['middleware' => 'auth:api'], function () {
    /*
     * User
     */
    Route::apiResources([
        'users' => \App\Http\Controllers\UserController::class,
        'products' => \App\Http\Controllers\ProductController::class
    ]);

});
