<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\EmailOrPhoneRequired;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Auth::user()->contacts;
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['nullable', 'string', 'email', 'max:255', new EmailOrPhoneRequired],
            'phone' => ['nullable', 'string', 'max:15', new EmailOrPhoneRequired],
        ]);

        Auth::user()->contacts()->create($request->all());

        return redirect()->route('contacts.index');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['nullable', 'string', 'email', 'max:255', new EmailOrPhoneRequired],
            'phone' => ['nullable', 'string', 'max:15', new EmailOrPhoneRequired],
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index');
    }
}