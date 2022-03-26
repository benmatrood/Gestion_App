<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palierprivilege extends Model
{
    use HasFactory;
    protected $fillable = ['nb_point'];
  // relation un a plusieurs entre palierprivileges et articles
    // qui retoune les info des palierprivilegesavec leurs articles
    public function r_palierprivilege_article()
    {
        return $this->hasMany(Article::class,"palierprivilege_id","id");
    }

}
