<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relation plusieurs a plusieurs entre users et roles
    // qui retoune les info des users  avec les roles
    public function r_user_role()
    {
        return $this->belongsToMany(Role::class,"user_role","user_id","role_id");
    }
    // relation plusieurs a plusieurs entre  users et permissions 
    // qui retoune les info des users  avec les permissions
    public function r_user_permission()
    {
        return $this->belongsToMany(Permission::class,"user_permission","user_id","permission_id");
    }

    // Vérifie le role de l'utilisateur
    public function hasRole($role)
    {
        return $this->r_user_role->where('nom_role',$role)->first() !==null;
    }
    // Vérifier si l'utilisateur a plusieurs roles
    public function hasAnyRoles($roles)
    {
        return $this->r_user_role->whereIn('nom_role',$roles)->first() !==null;
    }
   
}
