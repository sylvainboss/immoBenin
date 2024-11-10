@extends('admin-layout')

@section('admin')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Informations du Bien</h4>
            </div>
            <div class="card-body">



                <!-- Champ Nom -->
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $property->nom }}"
                        readonly>
                </div>

                <!-- Champ Adresse -->
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse"
                        value="{{ $property->adresse }}" readonly>
                </div>

                <!-- Sélection de la Ville -->
                <div class="mb-3">
                    <label for="ville_id" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="ville_id" name="ville_id"
                        value="{{ $property->ville->nom }}" readonly>
                </div>

                <!-- Champ Prix -->
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" class="form-control" id="prix" name="prix" value="{{ $property->prix }}"
                        readonly>
                </div>

                <!-- Sélection du Type -->
                <div class="mb-3">
                    <label for="type_id" class="form-label">Type</label>
                    <input type="text" class="form-control" id="ville_id" name="ville_id"
                        value="{{ $property->type->type }}" readonly>
                </div>

                <!-- Champ Superficie -->
                <div class="mb-3">
                    <label for="superficie" class="form-label">Superficie</label>
                    <input type="text" class="form-control" id="superficie" name="superficie"
                        value="{{ $property->superficie }}" readonly>
                </div>

                <!-- Champ Catégorie -->
                <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <input type="text" class="form-control" id="categorie" name="categorie"
                        value="{{ $property->categorie }}" readonly>
                </div>

                <!-- Nombre de pièces -->
                <div class="mb-3">
                    <label for="nombre_piece" class="form-label">Nombre de Pièces</label>
                    <input type="number" class="form-control" id="nombre_piece" name="nombre_piece"
                        value="{{ $property->nombre_piece }}" readonly>
                </div>

                <!-- Document (Affichage avec bouton pour ouvrir le document) -->
                <div class="mb-3">
                    <label for="document" class="form-label">Document</label>
                    @if ($property->document)
                        <a href="{{ asset('storage/' . $property->document) }}" class="btn btn-primary btn-sm"
                            target="_blank">Voir le Document</a>
                    @else
                        <p class="text-muted">Aucun document associé.</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Images de l'annonce</label>
                    <!-- Afficher les images actuelles -->
                    <div class="mt-2">
                        @foreach ($property->images as $image)
                            <a href="{{ asset('storage/' . $image->url) }}">
                                <img src="{{ asset('storage/' . $image->url) }}" alt="Image" width="100"
                                    class="me-2 mb-2">
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Bouton de Publication si l'annonce n'est pas encore publiée (accept == false) -->
                @if (!$property->accept)
                    <form action="{{ route('dashboard.publishProperty', $property->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <button type="submit" class="btn btn-success" name="action" value="publish">Publier
                            l'Annonce</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
