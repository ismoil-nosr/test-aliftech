<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $contacts = new Contact;
        $attr = $request->validate([
            'find' => 'required|string|min:3|max:30'
        ]);

        $result = $contacts->with(['phones', 'emails'])
            ->where('name', 'like', "%{$attr['find']}%")
            ->orWhereHas('phones', function($q) use ($attr) {
                $q->where('value', '=', "{$attr['find']}");
            })
            ->orWhereHas('emails', function($q) use ($attr) {
                $q->where('value', '=', "{$attr['find']}");
            })
            ->paginate(5);
        
        return view('search', compact('result'));
    }
}