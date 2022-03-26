<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    // relation plusieurs a plusieurs entre permissions et users
    // qui retoune les info des permissions avec les users
    public function r_permission_user()
    {
        return $this->belongsToMany(User::class,"user_permission","permission_id","user_id");
    }
}
