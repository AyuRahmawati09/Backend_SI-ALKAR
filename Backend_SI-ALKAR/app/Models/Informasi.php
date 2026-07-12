<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'informasi';
    protected $primaryKey = 'id_informasi';
    protected $fillable = ['id_admin', 'judul', 'isi', 'status'];
}
