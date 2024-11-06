<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = ['pengajar_id', 'judul', 'deskripsi', 'batas_waktu', 'file'];

    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

    // Relasi many-to-many dengan kelas
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_tugas')->withTimestamps(); // Menyertakan timestamps
    }

    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class, 'tugas_id');
    }
}