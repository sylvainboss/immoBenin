@extends('admin-layout')

@section('admin')
    <div class="page-inner">
        <div class="card card-profile">
            <div class="card-header" style="background-image: url('/path/to/banner.jpg');">
                <div class="profile-picture">
                    <div class="avatar avatar-xl">
                        <!-- Avatar Image (User Profile Picture) -->
                        <img src="{{ asset('storage/' . $user->picture) }}" alt="User Profile Picture"
                            class="avatar-img rounded-circle">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="user-profile text-center">
                    <div class="name">{{ $user->name }}</div>
                    <div class="job">{{ $user->role }}</div>
                    <div class="desc">Membre depuis : {{ $user->created_at->format('d M Y') }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Détails de l'utilisateur</h4>
            </div>
            <div class="card-body">
                <form>
                    <!-- Nom -->
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                    </div>

                    <!-- Telephone -->
                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" value="{{ $user->telephone }}" readonly>
                    </div>

                    <!-- Adresse -->
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" id="adresse" value="{{ $user->adresse }}" readonly>
                    </div>

                    <!-- Ville -->
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input type="text" class="form-control" id="ville" value="{{ $user->ville }}" readonly>
                    </div>

                    <!-- Profession -->
                    <div class="form-group">
                        <label for="profession">Profession</label>
                        <input type="text" class="form-control" id="profession" value="{{ $user->profession }}" readonly>
                    </div>

                    <!-- Role -->
                    <div class="form-group">
                        <label for="role">Rôle</label>
                        <input type="text" class="form-control" id="role" value="{{ $user->role }}" readonly>
                    </div>

                    <!-- Date de vérification de l'email -->
                    <div class="form-group">
                        <label for="email_verified_at">Email Vérifié</label>
                        <input type="text" class="form-control" id="email_verified_at"
                            value="{{ $user->email_verified_at ? $user->email_verified_at->format('d M Y') : 'Non vérifié' }}"
                            readonly>
                    </div>

                    <!-- Admin -->
                    <div class="form-group">
                        <label for="admin">Admin</label>
                        <input type="text" class="form-control" id="admin"
                            value="{{ $user->admin ? 'Oui' : 'Non' }}" readonly>
                    </div>



                    <!-- Document d'Identité -->
                    <div class="form-group">
                        <label for="indentite">Document d'identité</label><br>
                        @if ($user->indentite)
                            <a href="{{ asset('storage/' . $user->indentite)}}" target="_blank"
                                class="btn btn-primary">Voir le document</a>
                        @else
                            <p>Aucun document disponible</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
