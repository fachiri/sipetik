<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['report_id' ,'user_id', 'judul', 'jenis', 'kategori', 'isi', 'tanggal', 'lampiran', 'bukti'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('judul', 'like', '%'.$query.'%')
                ->orWhere('isi', 'like', '%'.$query.'%');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function teknisi()
    {
        return $this->belongsToMany(Teknisi::class, 'assignments')
            ->withPivot('status');;
    }

    public function chat()
    {
        return $this->hasMany(Chat::class);
    }
}
