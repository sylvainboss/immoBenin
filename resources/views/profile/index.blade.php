@extends('profile.layout')

@section('profile')
    <div class="container" style="width: 900px">
        <!-- Vérification des messages de succès ou d'erreur dans la vue -->
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

        <div class="row g-4 mb-4">
            <!-- Statistiques - Nombre d'annonces -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title">Annonces publiées</h5>
                        <p class="card-text fs-3 fw-bold text-primary">
                            {{ $totalAnnonce }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Statistiques - Profit généré -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title">Profit généré</h5>
                        <p class="card-text fs-3 fw-bold text-success">
                            {{ number_format(0 ?? 0, 0, ',', ' ') }} CFA
                        </p>
                    </div>
                </div>
            </div>
            <!-- Bouton 'Devenez propriétaire maintenant' pour les utilisateurs simples -->
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    @if (Auth::user()->role === 'user')
                        <form action="{{ route('profile.becomeOwner') }}" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary btn-lg shadow-lg"
                                style="padding: 0.75rem 1.5rem; border-radius: 0.5rem;">
                                <i class="bi bi-house-door-fill me-2"></i> Devenez propriétaire maintenant
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endsection
