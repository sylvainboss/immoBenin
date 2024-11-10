@extends('admin-layout')

@section('admin')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Compléter les informations du profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.complete') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone"
                                value="{{ old('telephone', $user->telephone) }}">
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse"
                                value="{{ old('adresse', $user->adresse) }}">
                        </div>

                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville"
                                value="{{ old('ville', $user->ville) }}">
                        </div>

                        <div class="mb-3">
                            <label for="profession" class="form-label">Profession</label>
                            <input type="text" class="form-control" id="profession" name="profession"
                                value="{{ old('profession', $user->profession) }}">
                        </div>

                        <div class="mb-3">
                            <label for="indentite" class="form-label">Document d'identité (PDF ou image)</label>
                            <input type="file" class="form-control" id="indentite" name="indentite"
                                accept="application/pdf,image/*">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Enregistrer les informations</button>
                    </form>
                </div>
            </div>

            <!-- Section de mise à jour des informations de profil -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Mettre à jour les informations du profil</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Section de mise à jour du mot de passe -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Changer le mot de passe</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Section de suppression de compte -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Supprimer le compte</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Section d'upload de la photo de profil -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Mettre à jour la photo de profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('upload-avatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Choisir une photo</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            @if (Auth::user()->picture)
                                <img src="{{ asset('storage/' . Auth::user()->picture) }}" alt="Avatar actuel"
                                    class="rounded-circle me-3" width="80" height="80" style="object-fit: cover;">
                            @endif
                            <button type="submit" class="btn btn-primary">Mettre à jour la photo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
