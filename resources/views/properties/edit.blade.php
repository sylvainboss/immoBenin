@extends('profile.layout')

@section('profile')
    <div class="container" style="width: 900px">
        <div class="row justify-content-center">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Mettez à jour votre annonce</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('property.xyz.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Pour indiquer que nous faisons une mise à jour -->
                        
                        <!-- Nom de l'annonce -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de l'annonce</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $property->nom) }}" required>
                        </div>

                        <!-- Adresse -->
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $property->adresse) }}" required>
                        </div>

                        <!-- Ville -->
                        <div class="mb-3">
                            <label for="ville_id" class="form-label">Ville</label>
                            <select class="form-select" id="ville_id" name="ville_id" required>
                                <option value="">Sélectionnez une ville</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id }}" 
                                        @if($ville->id == $property->ville_id) selected @endif>
                                        {{ $ville->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Prix -->
                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix (CFA)</label>
                            <input type="number" class="form-control" id="prix" name="prix" value="{{ old('prix', $property->prix) }}" required>
                        </div>

                        <!-- Type de bien -->
                        <div class="mb-3">
                            <label for="type" class="form-label">Type de bien</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">Sélectionnez un type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" 
                                        @if($type->id == $property->type_id) selected @endif>
                                        {{ $type->type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Superficie -->
                        <div class="mb-3">
                            <label for="superficie" class="form-label">Superficie (m²)</label>
                            <input type="number" class="form-control" id="superficie" name="superficie" value="{{ old('superficie', $property->superficie) }}" required>
                        </div>

                        <!-- Nombre de pièces -->
                        <div class="mb-3">
                            <label for="nombre_piece" class="form-label">Nombre de pièces (optionnel)</label>
                            <input type="number" class="form-control" id="nombre_piece" name="nombre_piece" value="{{ old('nombre_piece', $property->nombre_piece) }}" min="0">
                        </div>

                        <!-- Document PDF pour vérification -->
                        <div class="mb-3">
                            <label for="document" class="form-label">Document de vérification (PDF)</label>
                            <input type="file" class="form-control" id="document" name="document" accept="application/pdf">
                            <!-- Afficher le document actuel si existe -->
                            @if($property->document)
                                <a href="{{ asset('storage/' . $property->document) }}" target="_blank">Voir le document actuel</a>
                            @endif
                        </div>

                        <!-- Images de l'annonce -->
                        <div class="mb-3">
                            <label for="images" class="form-label">Images de l'annonce</label>
                            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
                            <!-- Afficher les images actuelles -->
                            <div class="mt-2">
                                @foreach ($property->images as $image)
                                    <img src="{{ asset('storage/' . $image->url) }}" alt="Image" width="100" class="me-2 mb-2">
                                @endforeach
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <button type="submit" class="btn btn-primary">Mettre à jour l'annonce</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
