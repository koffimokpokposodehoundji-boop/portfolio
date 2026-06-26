<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
  protected $fillable = ['titre', 'categorie', 'description', 'lien_github', 'image'];  //
}
