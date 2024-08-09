<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('login');
});

Route::get("/register", function(){
    return view("register");
});


Route::post("/register", [UserController::class, "store"]);

Route::post('/login', [AuthController::class, 'login']);