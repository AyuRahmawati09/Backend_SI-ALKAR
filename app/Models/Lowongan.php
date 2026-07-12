<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $primaryKey = 'id_lowongan';
    protected $fillable = [
        'id_admin', 
        'perusahaan', 
        'posisi', 
        'deskripsi', 
        'lokasi', 
        'tanggal_posting', 
        'batas_pendaftaran', 
        'status'
    ];
}
