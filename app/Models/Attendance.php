<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'in',
        'out',
        'employees_id',
    ];

    // public function employees()
    // {
    //     return $this->belongsToMany(Employee::class);
    // }
}
