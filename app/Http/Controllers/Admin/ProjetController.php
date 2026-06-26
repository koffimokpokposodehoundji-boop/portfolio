<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProjetController extends Controller
{
    public function index() {
        $projets = Projet::all(); // On récupère TOUT
        return view('admin', compact('projets'));
    }

   public function store(Request $request)
{
    $request->validate([
        'titre' => 'required',
        'categorie' => 'required',
        'description' => 'required',
        'image' => 'required', // C'est ici qu'on reçoit le nom de l'icône
    ]);

    $projet = new Projet();
    $projet->titre = $request->titre;
    $projet->categorie = $request->categorie;
    $projet->description = $request->description;
    $projet->lien_github = $request->lien_github;

    // On stocke le nom de l'icône (ex: "fab fa-php") dans la colonne image
    $projet->image = $request->image;

    $projet->save();

    return redirect()->back()->with('success', 'Projet ajouté avec succès !');
}

public function destroy($id)
{
    $projet = Projet::findOrFail($id);
    // Plus besoin de supprimer de fichier avec Storage::delete
    $projet->delete();

    return redirect()->back()->with('success', 'Projet supprimé avec succès !');
}
}
