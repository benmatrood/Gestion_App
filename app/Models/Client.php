<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['nom_client','prenom_client','adresse_client','telephone_client','email_client'];
    // relation un a plusieurs entre clients et commandes
    // qui retoune les info des clients avec leurs commandes
    public function r_client_commande()
    {
        return $this->hasMany(Commande::class,"client_id","id");
    }
}
