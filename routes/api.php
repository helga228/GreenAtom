<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/event/create', [\App\Http\Controllers\EventController::class, 'create']);
Route::post('/event/delete', [\App\Http\Controllers\EventController::class, 'delete']);
Route::post('/event/list', [\App\Http\Controllers\EventController::class, 'list']);
Route::post('/event/detail', [\App\Http\Controllers\EventController::class, 'detail']);
