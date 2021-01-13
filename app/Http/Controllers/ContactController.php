<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('name')->paginate(5);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\ContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $attr = $request->validated();

        $data = array_merge(
            ['emails' => $attr['emails']],
            ['phones' => $attr['phones']]
        );

        $contact = DB::transaction(function () use ($attr, $data) {
            $contact = Contact::create(['name' => $attr['name']]);
            $contact->relationsBulkInsert($data);

            return $contact;
        });

        return redirect()->route('contacts.show', $contact->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $contact->load(['emails', 'phones']);
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $contact->load(['emails', 'phones']);
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ContactUpdateRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $attr = $request->validated();

        $data = array_merge(
            ['emails' => $attr['emails']],
            ['phones' => $attr['phones']]
        );

        DB::transaction(function () use ($contact, $attr, $data) {
            $contact->update(['name' => $attr['name']]);
            $contact->relationsBulkUpdate($data);
        });

        return redirect()->route('contacts.show', $contact->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect('/');
    }
}
