<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['numero_cart'];
    // relation un a plusieurs entre clients et commandes
    // qui retoune les info des clients avec leurs commandes
    public function r_client_commande()
    {
        return $this->hasMany(Commande::class,"client_id","id");
    }
}
