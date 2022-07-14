<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    // relation un a plusieurs entre commandes et detailcommande
    // qui retoune les info des commandes avec leurs detailcommande
    public function r_commande_detailcommande()
    {
        return $this->hasMany(DetailCommande::class,"commande_id","id");
    }
    // relation un a un  entre commandes et clients
    // qui retoune les info de chaque clients avec les commandes
    public function r_commande_client()
    {
        return $this->belongsTo(Client::class,"client_id","id");
    }
    // relation un a un  entre commandes et statutcommandes
    // qui retoune les info de chaque statutcommandes avec les commandes
    public function r_commande_statutcommande()
    {
        return $this->belongsTo(StatutCommande::class,"statutcommande_id","id");
    }
    // relation un a un  entre commandes et users
    // qui retoune les info de chaque users avec les commandes
    public function r_commande_user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
    // relation un a un  entre commandes et livraisons
    // qui retoune les info de chaque livraisons avec les commandes
    public function r_commande_livraison()
    {
        return $this->belongsTo(Livraison::class,"livraison_id","id");
    }
    // relation un a un  entre commandes et boutiques
    // qui retoune les info de chaque boutiques avec les commandes
    public function r_commande_boutique()
    {
        return $this->belongsTo(Boutique::class,"boutique_id","id");
    }
     // relation plusieurs a plusieurs entre commandes et articles 
    // qui retoune les info des commandes  avec leurs articles en details
    public function r_commande_article()
    {
        return $this->belongsToMany(Article::class,"detail_commande","commande_id","article_id");
    }
}
