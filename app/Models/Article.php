<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['nom_article', 'reference_article', 'stock','url_image', 'despription', 'groupe_id','famille_id','sousfamille_id','palierprivilege_id'];

    // relation un a un  entre articles et groupes 
    // qui retoune les info de l'articles avec son groupe 
    public function r_article_groupe()
    {
        return $this->belongsTo(Groupe::class,"groupe_id","id");
    }
    
    // relation un a un  entre articles et familles
    // qui retoune les info de l'articles avec sa famille
    public function r_article_famille()
    {
        return $this->belongsTo(Famille::class,"famille_id",'id');
    }

    // relation un a un  entre articles et sousfamilles
    // qui retoune les info de l'articles avec sa sousfamille
    public function r_article_sousfamille()
    {
        return $this->belongsTo(Sousfamille::class,"sousfamille_id",'id');
    }
    
    // relation un a un  entre articles et palierprivileges
    // qui retoune les info de l'articles avec son palierprivilege
    public function r_article_palierprivilege()
    {
        return $this->belongsTo(Palierprivilege::class,"palierprivilege_id",'id');
    }

    // relation un a plusieurs entre articles et detail_commande
    // qui retoune les info des articles avec leurs detail_commande
    public function r_article_detail_commande()
    {
        return $this->hasMany(DetailCommande::class,"article_id","id");
    }
    // relation plusieurs a plusieurs entre articles et commandes
    // qui retoune les info des articles avec leurs commandes
    public function r_article_commande()
    {
        return $this->belongsToMany(Commande::class,"detail_commande","article_id","commande_id");
    }
}
