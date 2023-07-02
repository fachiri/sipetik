<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['user_id', 'judul', 'jenis', 'kategori', 'isi', 'tanggal', 'lampiran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}