<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Models\Ticker;

Route::get("/", [Authcontroller::class, "login"]);

Route::get("tickers", function(){
    return Ticker::all();
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
