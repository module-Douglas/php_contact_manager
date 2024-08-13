<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

  public function session() {
    if (Auth::check()) {
      $user = Auth::user();
      return redirect('/show-contacts');
    } else {
      return redirect('/login');
    }
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|string|email|max:255',
      'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
      return redirect('login')->with('error', 'Invalid credentials. Please try again.');
    }

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      session(['user_id' => $user->id, 'user_name' => $user->name]);
      return redirect()->intended('show-contacts');
    }

    return redirect('login')->with('error', 'Invalid credentials. Please try again.');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }
}