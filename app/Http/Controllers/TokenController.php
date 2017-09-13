<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationToken;

class TokenController extends Controller
{
    public function index()
    {
        return view('token.index');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $token = uniqid();
        Mail::to($request->email)->send(new RegistrationToken($token));

        // TODO: save email and token to database

        session()->flash('success', 'Pakvietimas sėkmingai išsiųstas!');
        return redirect()->route('token.index');
    }
    public function create($token)
    {
        dd($token);
        // TODO: check if token available. If true - show registration form with email field filled
    }
}
