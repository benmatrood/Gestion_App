<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sousfamille extends Model
{
    use HasFactory;
    protected $fillable = ['nom_sousfamille'];
    // relation un a plusieurs entre sousfamilles et articles
    // qui retoune les info des sousfamilles avec leurs articles
    public function r_sousfamille_article()
    {
        return $this->hasMany(Article::class,"sousfamille_id","id");
    }
    
}
