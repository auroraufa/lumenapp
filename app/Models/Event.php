<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = "events";
    protected $fillable = ['jenis', 'kategori_id', 'nama_event', 'date', 'created_at', 'updated_at'];

}