<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $creds = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(auth()->attempt($creds)) {
            return redirect()->intended();
        }
        return redirect()->back()->withErrors('Invalid combination!');
    }

    public function logout() {
        auth()->logout();
        return redirect(route('get.login'));
    }
}
