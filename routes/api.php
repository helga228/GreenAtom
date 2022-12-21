<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\PersonAnswerController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('registration', 'App\Http\Controllers\AuthController@registration');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

    Route::post('/event/create', [EventController::class, 'create']);
    Route::get('/event/delete', [EventController::class, 'delete']);
    Route::get('/event/list', [EventController::class, 'list']);
    Route::get('/event/detail', [EventController::class, 'detail']);

    Route::post('/task/create', [TaskController::class, 'create']);

    Route::get('/visit', [EventController::class, 'statistic']);

    Route::get('/statistic', [EventController::class, 'getStatistic']);

    Route::get('/person/list', [PersonAnswerController::class, 'personList']);

    Route::get('/personAnswer/detail', [PersonAnswerController::class, 'personAnswer']);
});


Route::post('/person/create', [PersonController::class, 'create']);

Route::post('/personAnswer/create', [PersonAnswerController::class, 'create']);



