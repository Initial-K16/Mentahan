<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = ['judul', 'deskripsi', 'url', 'file', 'pengajar_id']; // Tambahkan 'pengajar_id' di sini

    // Relasi dengan model User
    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

     // Relasi many-to-many dengan kelas
     public function kelas()
     {
        return $this->belongsToMany(Kelas::class, 'kelas_materi')->withTimestamps(); // Menyertakan timestamps
     }
}