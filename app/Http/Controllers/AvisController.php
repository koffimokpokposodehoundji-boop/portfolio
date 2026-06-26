<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:255',
            'message' => 'required'
        ]);

        Avis::create($request->all());

        return back()->with('success', 'Merci pour votre avis !');
    }
}
