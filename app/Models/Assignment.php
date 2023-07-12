<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'report_id',
        'teknisi_id',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class);
    }
}
