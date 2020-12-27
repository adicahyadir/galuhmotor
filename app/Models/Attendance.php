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
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
