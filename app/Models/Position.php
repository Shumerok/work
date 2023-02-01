<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function employees()
    {
        return $this->hasMany(Employer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
