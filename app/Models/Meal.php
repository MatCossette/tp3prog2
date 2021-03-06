<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;

    protected $fillable = [
        'image',
        'description',
        'user_id',
        'meteo',
        'created_at'
    ];
}
