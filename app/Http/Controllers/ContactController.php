<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
  public function showContacts()
  {
    $user = Auth::user();
    if (!$user) {
      return redirect("/login");
    }

    $contacts = $user->contacts;
    return view('showContacts', compact('contacts'));
  }

     public function store(Request $request)
    {
      $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|string|email|max:255',
        'phone' => 'nullable|string|max:15',
      ]);

      $user = Auth::user();
      if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

      $contact = $user->contacts()->create($request->all());

      return response()->json(
        ['success' => true,
        'contact' => $contact,]
      );
    }

    public function update(Request $request, Contact $contact)
    {
      $request->validate([
        'name' => 'required|string|max:255',
        'email' => ['nullable', 'string', 'email', 'max:255'],
        'phone' => ['nullable', 'string', 'max:15'],
      ]);

      
      $contact->update($request->all());

      return response()->json(
        ['success' => true,
        'contact' => $contact,]
      );
    }

    public function destroy(Contact $contact)
    {
      $contact->delete();
      return response()->json([
        'success' => true,
    ]);
    }
}