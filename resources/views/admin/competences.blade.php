<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Compétences</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-slate-50 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-blue-600">Gérer mes Compétences</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulaire d'ajout --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm mb-10 border border-slate-200">
            <form action="{{ route('admin.competences.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf
                <input type="text" name="nom" placeholder="Nom (ex: Laravel)" class="p-3 bg-slate-100 rounded-xl outline-none focus:ring-2 focus:ring-blue-400" required>
                <input type="number" name="niveau" placeholder="Niveau % (0-100)" class="p-3 bg-slate-100 rounded-xl outline-none focus:ring-2 focus:ring-blue-400" required>
                <input type="text" name="icone" placeholder="Icône (ex: fab fa-laravel)" class="p-3 bg-slate-100 rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                <button type="submit" class="md:col-span-3 bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg">
                    Ajouter la compétence
                </button>
            </form>
        </div>

        {{-- Liste des compétences --}}
        <div class="grid gap-4">
            @forelse($competences as $comp)
                <div class="bg-white p-4 rounded-xl shadow-sm flex justify-between items-center border border-slate-100">
                    <div class="flex items-center gap-4 w-1/4">
                        <i class="{{ $comp->icone ?? 'fas fa-code' }} text-2xl text-blue-500 w-8 text-center"></i>
                        <span class="font-bold">{{ $comp->nom }}</span>
                    </div>

                    <div class="flex-1 px-8">
                        <div class="w-full bg-slate-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $comp->niveau }}%"></div>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <span class="font-mono font-bold text-blue-600">{{ $comp->niveau }}%</span>

                        {{-- Bouton Supprimer --}}
                        <form action="{{ route('admin.competences.destroy', $comp->id) }}" method="POST" onsubmit="return confirm('Supprimer cette compétence ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 transition p-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-500 py-10 bg-white rounded-xl shadow-inner">Aucune compétence ajoutée pour le moment.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
