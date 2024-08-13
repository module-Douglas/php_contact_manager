<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::get("/", [AuthController::class, 'session']);

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::get("/register", function(){
    return view("register");
});
Route::post("/register", [UserController::class, "store"]);

Route::get("/logout", [AuthController::class, "logout"]);

Route::post("/contacts", [ContactController::class, "store"]);
Route::post('/contacts/{contact}', [ContactController::class, 'update']);
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy']);

Route::get('/show-contacts', [ContactController::class, 'showContacts']);