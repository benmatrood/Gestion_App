<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailcommande extends Model
{
    use HasFactory;
    // relation un a un  entre detailcommande et articles
    // qui retoune les info de chauqe articles avec les detailcommande 
    public function r_detailcommande_article()
    {
        return $this->belongsTo(Article::class,"article_id",'id');
    }
    // relation un a un  entre detailcommande et commandes
    // qui retoune les info de chauqe commandes avec les detailcommande 
    public function r_detailcommande_commande()
    {
        return $this->belongsTo(Commande::class,"commande_id",'id');
    }

}
