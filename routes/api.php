<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('hi', function () {
return 'hi';
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
