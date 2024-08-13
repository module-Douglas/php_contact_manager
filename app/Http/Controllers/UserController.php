<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

  private $user;

  function __construct(User $user) {
    $this->user = $user;
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
  
      if ($errors->has('name')) {
        return redirect('register')->with('error', $errors->first('name'));
      }

      if ($errors->has('email')) {
        return redirect('register')->with('error', $errors->first('email'));
      }
  
      if ($errors->has('password')) {
        return redirect('register')->with('error', $errors->first('password'));
      }
  
    }

    try {
      $this->user->create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
      ]);
      return redirect()->intended('login');
    } catch (\Exception $e) {
      return redirect('register')->with('error', $e->getMessage());
    }
  }

}