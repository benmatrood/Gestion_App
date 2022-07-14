<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
     // relation un a un  entre livraisons et commandes
    // qui retoune les info de chaque livraisons avec les commandes
    public function r_livraison_commande()
    {
        return $this->belongsTo(Commande::class,"commande_id","id");
    }
    // relation un a un  entre livraisons et users
    // qui retoune les info de chaque livraisons avec les users
    public function r_livraison_user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
