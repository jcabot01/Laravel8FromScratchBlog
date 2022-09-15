<?php

namespace App\Http\Controllers;


class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }


    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
