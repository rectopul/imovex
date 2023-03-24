<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('dashboard.auth.login.create');
    }

    public function store(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return response()->json([
                'redirect' => route('dashboard.index')
            ], 200);
            
        }

        return response()->json([
            'errors' => [
                'email' => 'Email ou senha inválidos.'
            ]
        ] , 422);
    }

    public function forgotPassword()
    {
        return view('auth.passwords.email');
    }

    public function destroy(Request $request)
	{
		Auth::logout();

		return [
            'redirect' => route('web.home.index')
        ];
	}
}
