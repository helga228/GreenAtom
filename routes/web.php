<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EventController;

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

Route::post('/event/create', [EventController::class, 'create']);
Route::get('/event/delete', [EventController::class, 'delete']);
Route::get('/event/list', [EventController::class, 'list']);
Route::get('/event/detail', [EventController::class, 'detail']);

Route::get('/tasks', [TaskController::class, 'list']);

Route::post('/person/create', [PersonController::class, 'create']);
Route::get('/answer/list', [\App\Http\Controllers\PersonAnswerController::class, 'answerList']);
