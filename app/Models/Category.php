<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function teknisi()
    {
        return $this->hasMany(Teknisi::class);
    }

    public function kabid()
    {
        return $this->hasOne(Kabid::class);
    }
}
