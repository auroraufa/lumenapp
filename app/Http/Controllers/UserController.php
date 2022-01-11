<?php

namespace App\Http\Controllers;

use App\Models\KategoriUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

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

    public function addKategori(Request $request)
    {
        $auth = Auth::user();
        $user_id = $auth->id;

        $kategoris = $request->input('kategoris');

        foreach ($kategoris as $kategori) {
            $kategori_user = KategoriUser::create([
                'user_id' => $user_id,
                'kategori_id' => $kategori
            ]);
        }

        return response()->json([
            'message' => 'Tema Favorite anda telah berhasil ditambah'
        ]);
    }

    public function showName($id)
    {
        $showUser = new stdClass();
        $data2 = User::where('id', $id)->select('nama')->get();
        $showUser->user = $data2;
        return response()->json($showUser);
    }

    public function EditProfile(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'oldPassword' => 'required',
            'newPassword' => 'required'
        ]);
        $user = User::where('id', $id)->first();
        $nama = $request->input('nama');
        $email = $request->input('email');
        $oldPassword = $request->input('oldPassword');
        if (Hash::check($oldPassword, $user->password)) {
            $newPassword = Hash::make($request->input('newPassword'));
            $user->update([
                'password' => $newPassword,
                'nama' => $nama,
                'email' => $email
            ]);
            return response()->json(['message' => 'Berhasil ubah kata sandi']);
        } else {
            return response()->json(['message' => 'Kata sandi lama tidak sesuai'], 401);
        }
    }
}
