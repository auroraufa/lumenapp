<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUser extends Model
{
    use HasFactory;
    protected $table = "kategori_users";
    protected $fillable = ['user_id', 'kategori_id'];
}
