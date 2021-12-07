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
    
     public function addpost(Request $request){
        $this->validate($request, [
            'id_event' => 'required',
            'jenis_event' => 'required',
            'nama_event' => 'required',
            'Deskripsi' => 'required',
            'tanggal_pelaksanaan' => 'required',
            'deadline_pendaftaran' => 'required',
            'waktu_pelaksanaan' => 'required',
            'benefit' => 'required',
            'persyaratan' => 'required',
            'ticket' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'link_pendaftaran' => 'required',
            'lokasi' => ' '
        ]);
        $id_event = $request->input('id_event');
        $jenis_event = $request->input('jenis_event');
        $nama_event = $request->input('nama_event');
        $Deskripsi = $request->input('Deskripsi');
        $tanggal_pelaksanaan = $request->input('tanggal_pelaksanaan');
        $deadline_pendaftaran = $request->input('deadline_pendaftaran');
        $waktu_pelaksanaan = $request->input('waktu_pelaksanaan');
        $benefit = $request->input('benefit');
        $persyaratan = $request->input('persyaratan');
        $ticket = $request->input('ticket');
        $harga = $request->input('harga');
        $kategori = $request->input('kategori');
        $link_pendaftaran = $request->input('link_pendaftaran');
        $lokasi = $request->input('lokasi');
         

        $addpost = Addpost::create([
            'id_event' => $id_event,
            'jenis_event' => $jenis_event,
            'nama_event' => $nama_event,
            'Deskripsi' => $Deskripsi,
            'tanggal_pelaksanaan' => $tanggal_pelaksanaan,
            'deadline_pendaftaran' => $deadline_pendaftaran,
            'waktu_pelaksanaan' => $waktu_pelaksanaan,
            'benefit' => $nama_event,
            'persyaratan' => $persyaratan,
            'ticket' => $ticket,
            'harga' => $harga,
            'kategori' => $link_pendaftaran,
            'lokasi' => $lokasi
        ]);

        return response()->json(['message' => 'Data berhasil ditambahkan']);
    }
}
