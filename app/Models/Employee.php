<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'address',
        'phone',
        'photo',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // public function attendances()
    // {
    //     return $this->belongsToMany(Attendance::class);
    // }
}
