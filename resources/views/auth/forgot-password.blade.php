@extends('user-layout')

@section('content')
<div class="container col-md-6" style="margin-top: 100px; margin-bottom:50px">
    <div class="mb-4 text-secondary">
        <p class="lead">Vous avez oublié votre mot de passe ? Pas de problème. Entrez simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe pour en choisir un nouveau.</p>
    </div>

    <!-- Affichage du statut de session -->
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- Formulaire de réinitialisation de mot de passe -->
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Adresse e-mail -->
        <div class="mb-3">
            <label for="email" class="form-label fs-6 text-uppercase fw-bold">Adresse e-mail</label>
            <input type="email" id="email" name="email" class="form-control ps-3" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton de soumission -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Envoyer le lien de réinitialisation
            </button>
        </div>
    </form>
</div>
@endsection
