<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    // relation plusieurs a plusieurs entre roles et users
    // qui retoune les info des roles avec les users
    public function r_role_user()
    {
        return $this->belongsToMany(User::class,"user_role","role_id","user_id");
    }
}
