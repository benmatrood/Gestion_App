<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boutique extends Model
{
    use HasFactory;
    // relation un a plusieurs entre boutiques et commandes
    // qui retoune les info des boutiques avec leurs commandes
    public function r_boutique_commande()
    {
        return $this->hasMany(Commande::class,"boutique_id","id");
    }
    // relation un a plusieurs entre boutiques et users
    // qui retoune les info des boutiques avec leurs users
    public function r_boutique_user()
    {
        return $this->hasMany(User::class,"boutique_id","id");
    }
}
