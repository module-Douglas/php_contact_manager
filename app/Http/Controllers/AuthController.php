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
      return redirect('/register');
  } else {
      return redirect('/login');
  }
  }

  public function login(Request $request)
  {
      // Validação dos campos
      $validator = Validator::make($request->all(), [
          'email' => 'required|string|email|max:255',
          'password' => 'required|string|min:8',
      ]);

      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      }

      $credentials = $request->only('email', 'password');
      if (Auth::attempt($credentials)) {
          $user = Auth::user();
          session(['user_id' => $user->id, 'user_name' => $user->name]);

          return redirect()->intended('dashboard');
      }

      return redirect()->back()->withErrors(['email' => 'As credenciais fornecidas estão incorretas.'])->withInput();
  }

  public function logout(Request $request)
  {
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect('/login');
  }
}