<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    protected $fillable = ['id_admin', 'periode_awal', 'periode_akhir', 'total_alumni', 'total_tracer'];
}
