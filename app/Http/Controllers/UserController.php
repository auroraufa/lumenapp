<?php

namespace App\Http\Controllers;

use App\Models\KategoriUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'username' => 'required',
            'password' => 'required|min:6'
        ]);
        $email = $request->input('email');
        $username = $request->input('username');
        $password = Hash::make($request->input('password'));
        $generateToken = bin2hex(random_bytes(40));

        $user = User::create([
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'token' => $generateToken
        ]);

        return response()->json([
            'message' => 'Pendaftaran pengguna berhasil dilaksanakan',
            'token' => $user->token,
            'idUser' => $user->id
        ]);
    }

    public function addKategrori(Request $request)
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();

        $this->validate($request, [
            'user_id' => $user,
            'kategori' => 'required'
        ]);
        $kategori = $request->input('kategori');

        $kategori_user = KategoriUser::create([
            'user_id' => $user,
            'kategori' => $kategori
        ]);

        return response()->json([
            'message' => 'Tema Favorite anda telah berhasil ditambah'
        ]);
    }
}
