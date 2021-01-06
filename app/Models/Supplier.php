<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'phone',
        'descriptions'
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function deleteById($data)
    {
        $supplier = Supplier::find($data);
        return $supplier->delete();    
    }
}
