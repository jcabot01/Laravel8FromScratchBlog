<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }


    public function store()
    {
        $attributes = request()->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        if(auth()->attempt($attributes)) {
            //auth fails
            throw ValidationException::withMessages([
                'email'=> 'Your provided credentials could not be verified.'
            ]);
        }

        //otherwise, auth passes to HAPPY path
        session()->regenerate();

        return redirect('/')->with('success', 'You have logged in.');
    }


    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
