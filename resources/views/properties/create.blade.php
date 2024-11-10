@extends('profile.layout')
@section('profile')
    <div class="container" style="width: 900px">
        <div class="row justify-content-center">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Créez votre annonce</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('property.xyz.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Nom de l'annonce -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de l'annonce</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>

                        <!-- Adresse -->
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                        </div>

                        <!-- Ville -->
                        <div class="mb-3">
                            <label for="ville_id" class="form-label">Ville</label>
                            <select class="form-select" id="ville_id" name="ville_id" required>
                                <option value="">Sélectionnez une ville</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Categorie --}}
                        <div class="mb-3">
                            <label for="categorie" class="form-label">Catégotie</label>
                            <select class="form-select" id="categorie" name="categorie" required>
                                <option value="">Sélectionnez une Catégorie</option>
                                    <option value="Vente">Vente</option>
                                    <option value="Location">Location</option>
                            </select>
                        </div>

                        <!-- Prix -->
                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix (CFA)</label>
                            <input type="number" class="form-control" id="prix" name="prix" required>
                        </div>

                        <!-- Type de bien -->
                        <div class="mb-3">
                            <label for="type" class="form-label">Type de bien</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">Sélectionnez un type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Superficie -->
                        <div class="mb-3">
                            <label for="superficie" class="form-label">Superficie (m²)</label>
                            <input type="number" class="form-control" id="superficie" name="superficie" required>
                        </div>

                        <!-- Nombre de pièces (optionnel) -->
                        <div class="mb-3">
                            <label for="nombre_piece" class="form-label">Nombre de pièces (optionnel)</label>
                            <input type="number" class="form-control" id="nombre_piece" name="nombre_piece" value="0"
                                min="0">
                        </div>

                        <!-- Document PDF pour vérification -->
                        <div class="mb-3">
                            <label for="document" class="form-label">Document de vérification (PDF)</label>
                            <input type="file" class="form-control" id="document" name="document"
                                accept="application/pdf" required>
                        </div>

                        <!-- Images de l'annonce -->
                        <div class="mb-3">
                            <label for="images" class="form-label">Images de l'annonce</label>
                            <input type="file" class="form-control" id="images" name="images[]" accept="image/*"
                                multiple required>
                        </div>

                        <!-- Bouton de soumission -->
                        <button type="submit" class="btn btn-primary">Créer l'annonce</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
