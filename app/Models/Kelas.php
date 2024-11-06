<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'jurusan'];

    // Relasi many-to-many dengan materi
    public function materis()
    {
        return $this->belongsToMany(Materi::class, 'kelas_materi')
                    ->withTimestamps();
    }

    // Relasi many-to-many dengan tugas
    public function tugas()
    {
        return $this->belongsToMany(Tugas::class, 'kelas_tugas')
                    ->withTimestamps();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'kelas_user', 'kelas_id', 'user_id');
    }
}