<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::get('/login', function () {
    return view('login');
});

Route::get("/register", function(){
    return view("register");
});


Route::post("/register", [UserController::class, "store"]);

Route::post('/login', [AuthController::class, 'login']);
Route::get("/", [AuthController::class, 'session']);

Route::get("/users", [UserController::class, "getAllUsers"]);

Route::get("/logout", [AuthController::class, "logout"]);

Route::get("/contacts", function(){
    return view("contacts");
});
Route::post("/contacts", [ContactController::class, "store"]);
Route::post('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

Route::get('/show-contacts', [ContactController::class, 'showContacts'])->name('contacts.showContacts');