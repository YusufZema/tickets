<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Authcontroller;
// use App\Models\Ticker;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\UserController;


// api / v1 / tickets / create
Route:: resource  ("tickets", TicketController::class);
Route:: middleware ('auth:sanctum')-> apiResource("/users", UserController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
