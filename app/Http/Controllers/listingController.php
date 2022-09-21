<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class listingController extends Controller
{
    public function index (Request $req) {
        // dd($req->tag);
        return view('listing.index', [ "listings" => Listing::latest()
            ->filter(['tag' => $req->tag, 'search' => $req->search ])
            ->paginate(6) ]);
    }

    public function show (Listing $id) {
        // dd($id->category->name);
        return view('listing.show', [ "listing" => $id ]);
    }
    
    public function create () {
        return view('listing.create', [ 'categories' => Category::all() ]);
    }

    public function store (Request $req){
        // dd($req->all());
        $formFields = $req->validate([
            'title' => 'required',
            'category_id' => 'required',// Rule::oneofcategories
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if($req->hasFile('logo')){
            $formFields['logo'] = $req->file('logo')->store('logos', 'public');
            // dd($formFields, $req->file('logo'));
        }
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Project created successfully');//->with('theme', 'green');
    }

    public function edit (Listing $id) {
        if (auth()->id() !== $id->user_id){
            abort(403, 'Not authorized');
        }
        // dd($id);
        return view('listing.edit', [ "listing" => $id, 'categories' => Category::all() ]);
    }

    public function update (Request $req, Listing $id){
        if (auth()->id() !== $id->user_id){
            abort(403, 'Not authorized');
        }
        // dd($req->all());
        $formFields = $req->validate([
            'title' => 'required',
            'category' => 'required',// Rule::oneofcategories
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if($req->hasFile('logo')){
            $formFields['logo'] = $req->file('logo')->store('logos', 'public');
            // dd($formFields, $req->file('logo'));
        }

        $id->update($formFields);

        return back()->with('message', 'Project updated successfully');//->with('theme', 'green');
    }

    public function destroy (Listing $id) {
        if (auth()->id() !== $id->user_id){
            abort(403, 'Not authorized');
        }
        $id->delete();
        // dd($id);
        return redirect('/')->with('message', 'Project deleted succesfully');
    }

    public function manage(){
        return view('listing.manage', [ 'listings' => auth()->user()->listings ]);
    }
    
}
