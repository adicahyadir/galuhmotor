<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
