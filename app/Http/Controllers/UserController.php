<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller {

  private $userService;

  function __construct(UserService $userService) {
    $this->userService = $userService;
  }

  public function login() {
    return view('login');
  }

  public function register() {
    return view('register');
  }

  public function store(Request $request) {
    //return response()->json($request->all());
    return response()->json($this->userService->register($request));
  }

  public function getAllUsers(Request $request) {

  }

}