<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;
    protected $fillable = ['nom_groupe'];
    
    // relation un a plusieurs entre groupes et articles
    // qui retoune les info des groupes avec leurs articles
    public function r_groupe_article()
    {
        return $this->hasMany(Article::class,"groupe_id","id");
    }
}