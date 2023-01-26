<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Employer extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $guarded = false;

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_created_id', 'id');
    }

//    public function getDateEmploymentAttribute($value)
//    {
//        return Carbon::createFromFormat('Y-m-d', $this->attributes['date_employment'])->format('d.m.Y');
//    }

//    public function setDateEmploymentAttribute($value)
//    {
//        return Carbon::createFromFormat('d.m.Y', $this->attributes['date_employment'])->format('yy-m-d');
//    }
//    public function getSalaryAttribute($value)
//    {
//        return '$'.number_format($this->attributes['salary'], 3);
//    }

}
