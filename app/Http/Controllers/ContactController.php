<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All companies', '');

        $contacts = Contact::latestFirst()->filter()->paginate(10);

        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function show($id)
    {
        $contact =  Contact::findOrFail($id);

        return view('contacts.show', compact('contact'));
    }

    public function create()
    {
        $contact = new Contact;

        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All companies', '');

        return view('contacts.create', compact('companies', 'contact'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('message', 'Contact has been added!');
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);

        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All companies', '');

        return View::make('contacts.edit', compact('companies', 'contact'));
    }

    public function update($id, Request $request)
    {

        $attributes = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        $contact = Contact::findOrFail($id);

        $contact->update($attributes);

        return redirect()->route('contacts.index')->with('message', 'Contact has been updated!');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect()->route('contacts.index')->with('message', 'Contact has been deleted!');
    }
}
