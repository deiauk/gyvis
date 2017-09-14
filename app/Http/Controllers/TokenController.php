<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationToken;
use App\Token;

class TokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => [
            'create'
        ]]);
    }

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

        Token::create([
            'token' => $token,
            'email' => $request->email
        ]);

        session()->flash('success', 'Pakvietimas sėkmingai išsiųstas!');
        return redirect()->route('token.index');
    }
    public function create($tkn)
    {
        $token = Token::whereToken($tkn)->first();
        return view('auth.register', compact('token'));
    }
}
