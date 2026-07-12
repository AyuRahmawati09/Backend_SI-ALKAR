<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TracerStudi extends Model
{
    protected $table = 'tracer_studi';
    protected $primaryKey = 'id_tracer';
    protected $fillable = [
        'id_alumni', 
        'pekerjaan', 
        'nama_perusahaan', 
        'status_pekerjaan', 
        'gaji', 
        'tanggal_isi', 
        'keterangan'
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni', 'id_alumni');
    }
}
