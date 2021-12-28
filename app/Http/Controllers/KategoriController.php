<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class KategoriController extends Controller
{
    public function getkategori()
    {
        $kategoriList = new stdClass();
        $kategori = Kategori::get();
        $kategoriList->kategori = $kategori;
        return response()->json($kategoriList);
    }
}
