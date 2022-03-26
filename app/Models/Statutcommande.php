<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statutcommande extends Model
{
    use HasFactory;

    // relation un a plusieurs entre statutcommande et commandes
    // qui retoune les info des statutcommande avec leurs commandes
    public function r_statutcommande_commande()
    {
        return $this->hasMany(Commande::class,"statutcommande_id","id");
    }
}
