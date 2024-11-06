<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;  
    protected $fillable = ['user_id', 'tugas_id', 'file', 'catatan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // Relasi ke model Tugas
     public function tugas()
     {
         return $this->belongsTo(Tugas::class, 'tugas_id'); // Pastikan 'tugas_id' sesuai
     }
 
     // Relasi ke model User (Pengajar)
     public function pengajar()
     {
         return $this->belongsTo(User::class, 'pengajar_id'); // jika ada kolom pengajar_id
     }
 }

