<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

        $divisi = DB::table('divisi')
        ->select('divisi.divisiID')
        ->join('pengurus', 'divisi.divisiID', '=', 'pengurus.divisiID')
        ->where('pengurus.pengurusID', $validatedData['pengurusID'])
        ->first();

        if($divisi == 'D01') {
            $role = 'Ketua';
        } else if($divisi == 'D02') {
            $role = 'Sekretaris';
        } else if($divisi == 'D03') {
            $role = 'Kewirausahaan';
        } else {
            $role = 'Internal&Eksternal';
        }

        $new_user = new User;
        $new_user->name = $validatedData['name'];
        $new_user->pengurusID = $validatedData['pengurusID'];
        $new_user->role = $role;
        $new_user->username = $validatedData['username'];
        $new_user->password = Hash::make($validatedData['password']);
        $new_user->save();

        return redirect('/login')->with('success', 'Registration Success, Please Login!');
    }
}
