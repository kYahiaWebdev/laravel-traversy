<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    public function create(){
        return view('user.register');
    }

    public function store(Request $req){
        $formFields = $req->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:5|confirmed'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'User created successfully & Logged-in');
    }

    public function logout(Request $req){
        auth()->logout();

        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/')->with('message', 'Logged out');
    }

    public function login(){
        return view('user.login');
    }

    public function authenticate(Request $req){
        $formFields = $req->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $req->session()->regenerate();
            return redirect('/')->with('message', 'User Logged-in');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    // public function destroy (User $id) {
    //     $id->listings->delete();
    //     $id->delete();
    //     // dd($id);
    //     return redirect('/')->with('message', 'User deleted succesfully');
    // }
}
