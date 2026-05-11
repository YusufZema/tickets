<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;

Route::get("/", [Authcontroller::class, "login"]);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
