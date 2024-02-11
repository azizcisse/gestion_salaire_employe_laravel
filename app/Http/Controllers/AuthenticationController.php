<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('authentication.login');
    }

    public function handleLogin(AuthenticationRequest $authenticationRequest)
    {

        $credentials = $authenticationRequest->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            return redirect()->route('tableaubord');
        } else {
            return redirect()->back()->with('error_msg', 'Information de Connexion invalide.');
        }
    }
}
