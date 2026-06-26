<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    public function index() {
        $competences = Competence::all();
        return view('admin.competences', compact('competences'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nom' => 'required',
            'niveau' => 'required|integer|min:0|max:100',
            'icone' => 'nullable'
        ]);

        Competence::create($data);
        return back()->with('success', 'Compétence ajoutée !');
    }
    public function destroy($id) {
    $competence = Competence::findOrFail($id);
    $competence->delete();

    return back()->with('success', 'Compétence supprimée avec succès !');
}
}
?>
