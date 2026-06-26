<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ProjetController;
use App\Http\Controllers\Admin\CompetenceController;
use App\Http\Controllers\AvisController;

// --- PAGES PUBLIQUES ---
Route::get('/', function () {
    return view('welcome');
});

// Route pour le formulaire de contact
Route::post('/contact', function (Request $request) {
    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ]);
    return back()->with('success', 'Merci ! Votre message a bien été envoyé.');
})->name('contact.send');

// Route pour les avis
Route::post('/avis/store', [AvisController::class, 'store'])->name('avis.store');


// --- ADMINISTRATION ---
Route::prefix('admin')->name('admin.')->group(function () {

    // Gestion des Projets (Lien : /admin/espoir)
    Route::get('/espoir', [ProjetController::class, 'index'])->name('index');
    Route::post('/projets/store', [App\Http\Controllers\Admin\ProjetController::class, 'store'])->name('projets.store');
    Route::delete('/projets/{id}', [App\Http\Controllers\Admin\ProjetController::class, 'destroy'])->name('projets.destroy');
    // Gestion des Compétences (Lien : /admin/competences)
    Route::get('/competences', [CompetenceController::class, 'index'])->name('competences.index');
    Route::post('/competences/store', [CompetenceController::class, 'store'])->name('competences.store');
    Route::delete('/competences/{id}', [CompetenceController::class, 'destroy'])->name('competences.destroy');
});
Route::get('/', function () {
    // On récupère toutes les compétences enregistrées
    $competences = \App\Models\Competence::all();
    $projets =\App\Models\Projet::all();
    return view('welcome', compact('competences', 'projets'));
});

?>
