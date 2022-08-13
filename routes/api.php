<?php

use App\Http\Controllers\ApiUserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('apilogin', [ApiUserController::class, 'login']);
Route::post('apiregister', [ApiUserController::class, 'register']);
Route::put('apiupdate-user/{id}', [ApiUserController::class, 'update']);
Route::post('apiupload-user/{id}', [ApiUserController::class, 'upload']);

