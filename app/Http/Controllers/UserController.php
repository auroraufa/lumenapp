<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'username' => 'required',
            'password' => 'required|min:6'
        ]);
        $email = $request->input('email');
        $username = $request->input('username');
        $password = Hash::make($request->input('password'));

        $user = User::create([
            'email' => $email,
            'username' => $username,
            'password' => $password
        ]);

        return response()->json(['message' => 'Pendaftaran pengguna berhasil dilaksanakan']);
    }
}
