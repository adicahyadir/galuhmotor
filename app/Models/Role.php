<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name',
    ];


    /**
     * App\User relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function getRole($request)
    {
        $role_id = DB::table('users')->where('email', '=', $request)->get()[0]->role_id;
        $data = DB::table('roles')->where('id', '=', $role_id)->get()[0]->name;
        return $data;
    }

    public function getRoleById($data)
    {
        $data = DB::table('roles')->where('id', '=', $data)->get()[0]->name;
        return $data;
    }
}
