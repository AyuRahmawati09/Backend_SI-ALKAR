<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';
    protected $primaryKey = 'id_alumni';
    protected $fillable = [
        'id_user', 
        'nim', 
        'nama', 
        'prodi', 
        'tahun_lulus', 
        'alamat', 
        'no_hp', 
        'foto', 
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function tracerStudi()
    {
        return $this->hasMany(TracerStudi::class, 'id_alumni', 'id_alumni');
    }
}
