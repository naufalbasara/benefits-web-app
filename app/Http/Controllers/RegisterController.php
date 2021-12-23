<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('register.index');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:users'],
            'pengurusID' => ['required', 'min:3', 'max:3', 'unique:users'],
            'username' => ['required', 'min:5', 'unique:users'],
            'password' => ['required', 'min:5']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration Success, Please Login!');
    }
}
