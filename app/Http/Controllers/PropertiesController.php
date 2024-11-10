<?php

namespace App\Http\Controllers;

use App\Models\BienImages;
use App\Models\Biens;
use App\Models\Notifications;
use App\Models\Types;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villes = Ville::all();
        $types = Types::all();
        return view('properties.index', [
            "properties" => Biens::with(["images"])->orderBy('created_at', "desc")->where('accept', true)->paginate(12),
            'villes' => $villes,
            'types' => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $villes = Ville::all();
        $types = Types::all();
        return view('properties.create', [
            'villes' => $villes,
            'types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== "owner") {

            return redirect()->route('profile')
                ->with('error', 'Vous n\'êtes pas un propriétaire.');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville_id' => 'required|exists:villes,id',
            'prix' => 'required|numeric|min:0',
            'type' => 'required|exists:types,id',
            'superficie' => 'required|numeric|min:0',
            'nombre_piece' => 'nullable|integer|min:0',
            'document' => 'required|file|mimes:pdf|max:2048',
            'categorie' => 'required|string|max:255',
            'images.*' => 'required|file|image|max:2048', // Maximum de 2MB par image
        ]);

        // Enregistrement du document PDF
        $documentPath = $request->file('document')->store('documents', 'public');

        // Création de l'annonce
        $property = new Biens();
        $property->nom = $request->nom;
        $property->adresse = $request->adresse;
        $property->ville_id = $request->ville_id;
        $property->prix = $request->prix;
        $property->type_id = $request->type;
        $property->superficie = $request->superficie;
        $property->nombre_piece = $request->nombre_piece ?: 0;
        $property->categorie = $request->categorie;
        $property->userid = $user->id;
        $property->accept = false;
        $property->document = $documentPath;
        $property->save();

        // Enregistrement des images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('property_images', 'public');

                BienImages::create([
                    'url' => $imagePath,
                    'bien_id' => $property->id,
                ]);
            }
        }

        return redirect()->route('profile')
            ->with('success', 'Votre annonce a été créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer l'annonce avec ses images, son type et sa ville
        $property = Biens::with(['images', 'type', 'ville'])->findOrFail($id);

        // Retourner la vue avec les informations de l'annonce
        return view('properties.detail', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer l'annonce spécifique avec ses images, son type, et sa ville
        $property = Biens::with('images', 'type', 'ville')->findOrFail($id);

        // Récupérer les villes et les types disponibles pour les sélecteurs
        $villes = Ville::all();
        $types = Types::all();

        // Passer les données à la vue
        return view('properties.edit', compact('property', 'villes', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville_id' => 'required|exists:villes,id',
            'prix' => 'required|numeric',
            'type' => 'required|exists:types,id',
            'superficie' => 'required|numeric',
            'nombre_piece' => 'nullable|numeric|min:0',
            'document' => 'nullable|file|mimes:pdf|max:2048',
            'images' => 'nullable|array',
            'categorie' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Trouver l'annonce
        $property = Biens::findOrFail($id);

        // Mise à jour des informations de l'annonce
        $property->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'ville_id' => $request->ville_id,
            'prix' => $request->prix,
            'type_id' => $request->type,
            'superficie' => $request->superficie,
            'categorie' => $request->categorie,
            'nombre_piece' => $request->nombre_piece ?? 0,
        ]);

        // Mise à jour du document PDF
        if ($request->hasFile('document')) {
            // Supprimer l'ancien document s'il existe
            if ($property->document) {
                Storage::delete('public/' . $property->document);
            }

            // Enregistrer le nouveau document
            $documentPath = $request->file('document')->store('documents', 'public');
            $property->update(['document' => $documentPath]);
        }

        // Mise à jour des images
        if ($request->hasFile('images')) {
            // Supprimer les anciennes images
            $property->images()->delete();

            // Enregistrer les nouvelles images
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('images', 'public');
                BienImages::create([
                    'bien_id' => $property->id,
                    'url' => $imagePath,
                ]);
            }
        }

        // Retourner une réponse de succès
        return redirect()->route('profile.properties')
            ->with('success', 'Annonce mise à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupère l'annonce avec les images associées
        $annonce = Biens::with('images')->find($id);

        // Vérifie si l'annonce existe
        if (!$annonce) {
            return redirect()->route('profile.properties')->with('error', 'Annonce non trouvée.');
        }

        // Vérifie si l'utilisateur connecté est le propriétaire de l'annonce
        if ($annonce->userid !== Auth::id()) {
            return redirect()->route('profile.properties')->with('error', 'Vous n\'êtes pas autorisé à supprimer cette annonce.');
        }

        // Suppression des images associées
        foreach ($annonce->images as $image) {
            // Supprime le fichier image du stockage
            Storage::delete($image->url);
            // Supprime l'enregistrement de l'image dans la table bien_images
            $image->delete();
        }

        // Suppression du document associé (si présent)
        if ($annonce->document) {
            Storage::delete($annonce->document);
        }

        // Supprime l'annonce
        $annonce->delete();

        // Redirection avec un message de succès
        return redirect()->route('profile.properties')->with('success', 'Annonce supprimée avec succès.');
    }

    public function searchProperties(Request $request)
    {
        // Récupérer les paramètres de recherche
        $categorie = $request->input('search_type');
        $ville_id = $request->input('location');
        $property_type_id = $request->input('type');
        $prix_min = $request->input('prix_min');
        $prix_max = $request->input('prix_max');

        // Requête de base
        $properties = Biens::query();

        // Filtrage selon les paramètres
        if ($categorie) {
            $properties->where('categorie', $categorie);
        }

        if ($ville_id) {
            $properties->where('ville_id', $ville_id);
        }

        if ($property_type_id) {
            $properties->where('type_id', $property_type_id);
        }

        if ($prix_min) {
            $properties->where('prix', '>=', $prix_min);
        }

        if ($prix_max) {
            $properties->where('prix', '<=', $prix_max);
        }

        // Récupérer les propriétés filtrées avec pagination
        $properties = $properties->paginate(12);

        // Récupérer les villes et types pour la vue
        $villes = Ville::all();
        $types = Types::all();

        // Passer les données à la vue
        return view('properties.index', compact('properties', 'villes', 'types'));
    }

    public function contact(Request $request, string $id){
        $request->validate([
            
            'message' => ['required', 'string'],
        ]);
        $contact = Notifications::create([
            'userid'=>$id,
            'message'=>$request->message,
        ]);
        return redirect()->back()->with('success', 'Votre message est correctement envoyé');
    }
}
