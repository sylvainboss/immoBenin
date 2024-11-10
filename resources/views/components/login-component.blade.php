<form method="POST" action="{{ route('login') }}" id="form3" class="form-group flex-wrap p-3">
    @csrf
    <!-- Adresse email -->
    <div class="form-input col-lg-12 my-4">
        <label for="exampleInputEmail3" class="form-label fs-6 text-uppercase fw-bold text-black">Adresse
            email</label>
        <input type="email" id="exampleInputEmail3" name="email" placeholder="Email"
            class="form-control ps-3" required autofocus>
        @error('email')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <!-- Mot de passe -->
    <div class="form-input col-lg-12 my-4">
        <label for="inputPassword3" class="form-label fs-6 text-uppercase fw-bold text-black">Mot de
            passe</label>
        <input type="password" id="inputPassword3" name="password" placeholder="Mot de passe"
            class="form-control ps-3" required>
        <div id="passwordHelpBlock2" class="form-text text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="password">Mot de passe oublié ?</a>
            @endif
        </div>
        @error('password')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <!-- Se souvenir de moi -->
    <label class="py-3">
        <input type="checkbox" name="remember" class="d-inline">
        <span class="label-body text-black">Se souvenir de moi</span>
    </label>

    <!-- Bouton de connexion -->
    <div class="d-grid my-3">
        <button type="submit"
            class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Connexion</button>
    </div>
</form>