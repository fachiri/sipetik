<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttrCriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria',
        'kode',
        'bobot'
    ];
}
