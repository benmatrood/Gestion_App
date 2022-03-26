<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    use HasFactory;
    protected $fillable = ['nom_famille'];
   // relation un a plusieurs entre familles et articles
    // qui retoune les info des familles avec leurs articles
    public function r_famille_article()
    {
        return $this->hasMany(Article::class,"famille_id","id");
    }

}
