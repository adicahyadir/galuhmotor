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
        'pegawai_id',
    ];

    public function employee()
    {
        return $this->belongsToMany(Pegawai::class);
    }
}
