<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portfolio | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-slate-50 pb-20">

    {{-- 1. SECTION HERO --}}
    <div class="relative w-full py-20 mb-10 text-center overflow-hidden">
        <div class="max-w-2xl mx-auto px-6 mb-6">
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm mb-4">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-200 text-red-700 px-6 py-4 rounded-2xl shadow-sm mb-4">
                    <ul class="text-sm list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="inline-flex items-center px-6 py-2 rounded-full bg-white/60 backdrop-blur-md border border-purple-100 mb-6 shadow-sm">
            <span class="w-5 h-5 bg-white rounded-lg flex items-center justify-center text-purple-600 mr-3 shadow-sm">
                <i class="fas fa-th-large text-xs"></i>
            </span>
            <span class="text-sm font-bold text-slate-700">Dashboard Admin</span>
        </div>

        <h1 class="text-6xl md:text-7xl font-black mb-6">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-600">
                Gestion de Portfolio
            </span>
        </h1>
        <p class="text-slate-500 text-lg font-medium max-w-2xl mx-auto leading-relaxed">
            Utilisez des icônes FontAwesome pour illustrer vos projets techniques.
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-6">

        {{-- 2. STATISTIQUES --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center space-x-4">
                <div class="w-14 h-14 bg-pink-100 text-pink-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fas fa-folder"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-800">{{ $projets->count() }}</p>
                    <p class="text-slate-500 text-sm">Projets totaux</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center space-x-4">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fas fa-icons"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-800">Iconic</p>
                    <p class="text-slate-500 text-sm">Design System</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center space-x-4">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-800">2</p>
                    <p class="text-slate-500 text-sm">Catégories</p>
                </div>
            </div>
        </div>

        {{-- 3. BOUTON D'ACTION --}}
        <div class="mb-10">
            <button id="btn-nouveau-projet" class="px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-2xl shadow-lg shadow-purple-200 hover:scale-105 transition-transform flex items-center">
                <i class="fas fa-plus mr-3"></i> Ajouter un nouveau projet
            </button>
        </div>

        {{-- 4. FORMULAIRE --}}
        <div id="formulaire-projet" class="{{ $errors->any() ? '' : 'hidden' }} bg-white rounded-[2rem] shadow-2xl border border-slate-50 overflow-hidden mb-16">
            <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-tr from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                        <i class="fas fa-code text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Nouveau projet</h2>
                        <p class="text-slate-500 text-sm">Configurez l'icône et les détails</p>
                    </div>
                </div>
                <button type="button" id="btn-fermer" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 text-slate-400 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('admin.projets.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Titre du projet *</label>
                        <input type="text" name="titre" value="{{ old('titre') }}" placeholder="Ex: Système de Gestion" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 focus:bg-white focus:ring-4 focus:ring-purple-100 transition outline-none" required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Catégorie *</label>
                        <select name="categorie" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 focus:bg-white outline-none" required>
                            <option value="" disabled selected>Choisir...</option>
                            <option value="web" {{ old('categorie') == 'web' ? 'selected' : '' }}>Développement Web</option>
                            <option value="java" {{ old('categorie') == 'java' ? 'selected' : '' }}>Application Java</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 ml-1">Description *</label>
                    <textarea name="description" rows="4" placeholder="Décrivez votre projet..." class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 focus:bg-white outline-none transition" required>{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Lien GitHub</label>
                        <input type="url" name="lien_github" value="{{ old('lien_github') }}" placeholder="https://github.com/..." class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 focus:bg-white outline-none">
                    </div>
                    {{-- MODIFICATION ICI : CHAMP TEXTE POUR L'ICÔNE --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Classe de l'icône FontAwesome *</label>
                        <input type="text" name="image" value="{{ old('image') }}" placeholder="ex: fab fa-laravel ou fas fa-database" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 focus:bg-white outline-none" required>
                        <p class="text-[10px] text-slate-400 ml-2 italic">Astuce: Utilisez la colonne 'image' de votre table pour stocker le nom de l'icône.</p>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                    <button type="button" id="btn-annuler" class="px-8 py-4 text-slate-500 font-semibold hover:text-red-500 transition-colors duration-300">
                        Annuler
                    </button>
                    <button type="submit" class="flex-1 ml-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-5 rounded-2xl shadow-xl shadow-purple-200 hover:scale-[1.01] transition-all">
                        <i class="fas fa-plus-circle mr-2"></i> Enregistrer le projet
                    </button>
                </div>
            </form>
        </div>

        {{-- 5. LISTE DES PROJETS --}}
        <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
            <i class="fas fa-list-ul mr-3 text-purple-600"></i> Vos Projets Actuels
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projets as $projet)
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden group hover:shadow-xl transition-shadow duration-300">
                    {{-- MODIFICATION ICI : AFFICHAGE DE L'ICÔNE EN GRAND --}}
                    <div class="h-48 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center relative overflow-hidden group-hover:from-purple-600 group-hover:to-indigo-600 transition-all duration-500">
                        <i class="{{ $projet->image }} text-7xl text-white/90 group-hover:scale-110 transition-transform duration-500"></i>

                        <div class="absolute top-4 right-4 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold text-white border border-white/20">
                            {{ ucfirst($projet->categorie) }}
                        </div>
                    </div>

                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-800 mb-2">{{ $projet->titre }}</h4>
                        <p class="text-slate-500 text-sm line-clamp-2 mb-4">{{ $projet->description }}</p>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition-colors">
                                <i class="fas fa-edit mr-1"></i> Modifier
                            </a>

                            <form action="{{ route('admin.projets.destroy', $projet->id) }}" method="POST" onsubmit="return confirm('Es-tu sûr de vouloir supprimer ce projet ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 text-sm font-medium transition-colors">
                                    <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-[2rem] border border-dashed border-slate-200">
                    <p class="text-slate-400">Aucun projet. Commencez par en ajouter un avec une icône !</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnNouveau = document.getElementById('btn-nouveau-projet');
            const btnAnnuler = document.getElementById('btn-annuler');
            const btnFermerX = document.getElementById('btn-fermer');
            const blockForm = document.getElementById('formulaire-projet');
            const actualForm = blockForm.querySelector('form');

            btnNouveau.addEventListener('click', () => {
                blockForm.classList.remove('hidden');
                blockForm.classList.add('animate-in');
                blockForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });

            const fermerEtVider = () => {
                blockForm.classList.add('hidden');
                actualForm.reset();
            };

            btnAnnuler.addEventListener('click', fermerEtVider);
            btnFermerX.addEventListener('click', fermerEtVider);
        });
    </script>

    <style>
        .animate-in { animation: slideIn 0.5s ease-out; }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
