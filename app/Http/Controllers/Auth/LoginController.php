<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller {

    public function __construct() {
        $this->middleware(['guest']);
    }

    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {


        // Validation
        try {
            $this->validate($request, ['email' => ['required', 'email'], 'username' => ['required'],]);
        } catch (ValidationException $e) {

        }

        // Sign the user in
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details.');
        }

        // Redirect
        return redirect()->route('dashboard');

    }
}
