<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model

{
    // On autorise Laravel à remplir ces colonnes
    protected $fillable = ['nom', 'niveau', 'icone'];
}  //
?>
