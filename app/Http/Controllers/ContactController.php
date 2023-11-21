<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::userCompanies();

        $contacts = auth()->user()->contacts()->latestFirst()->paginate(10);

        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function create()
    {
        $contact = new Contact;

        $companies = Company::userCompanies();

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

        $request->user()->contacts()->create($request->all());

        return redirect()->route('contacts.index')->with('message', 'Contact has been added!');
    }

    public function edit(Contact $contact)
    {
        $companies = Company::userCompanies();

        return View::make('contacts.edit', compact('companies', 'contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $attributes = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        $contact->update($attributes);

        return redirect()->route('contacts.index')->with('message', 'Contact has been updated!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('message', 'Contact has been deleted!');
    }

}
