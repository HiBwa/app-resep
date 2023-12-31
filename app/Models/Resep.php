<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'judul',
        'id_kategori',
        'deskripsi',
        'bahan',
        'langkah',
        'durasi',
    ];
}
