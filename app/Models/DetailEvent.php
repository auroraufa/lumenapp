<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEvent extends Model
{
    use HasFactory;
    protected $table = "detail_events";
    protected $fillable = ['id', 'benefit', 'persyaratan', 'ticket', 'harga', 'link_pendaftaran', 'latitude','longitude','pihak_penyelenggara', 'deskripsi', 'waktu', 'deadline'];

}