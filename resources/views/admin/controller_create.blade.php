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

    <form method="POST" action="{{ route('dashboard.create_controler') }}" id="form4" class="form-group flex-wrap p-3">
        @csrf

        <!-- Nom -->
        <div class="form-input col-lg-12 my-4">
            <label for="name" class="form-label fs-6 text-uppercase fw-bold text-black">Nom</label>
            <input type="text" id="name" name="name" placeholder="Nom" class="form-control ps-3"
                value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Adresse email -->
        <div class="form-input col-lg-12 my-4">
            <label for="exampleInputEmail4" class="form-label fs-6 text-uppercase fw-bold text-black">Adresse
                email</label>
            <input type="email" id="exampleInputEmail4" name="email" placeholder="Email" class="form-control ps-3"
                value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="form-input col-lg-12 my-4">
            <label for="inputPassword4" class="form-label fs-6 text-uppercase fw-bold text-black">Mot de passe</label>
            <input type="password" id="inputPassword4" name="password" placeholder="Mot de passe" class="form-control ps-3"
                required>
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="form-input col-lg-12 my-4">
            <label for="password_confirmation" class="form-label fs-6 text-uppercase fw-bold text-black">Confirmer le
                mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Confirmer le mot de passe" class="form-control ps-3" required>
            @error('password_confirmation')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <!-- Bouton d'inscription -->
        <div class="d-grid my-3">
            <button type="submit"
                class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Créez le controller</button>
        </div>

    </form>
@endsection
