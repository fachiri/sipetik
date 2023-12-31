<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('rate', 'like', '%'.$query.'%');
    }

    protected $fillable = ['user_id', 'rate', 'report_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
