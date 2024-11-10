<section class="my-5">
    <header class="mb-4">
        <h2 class="h4 text-danger">
            {{ __('Supprimer le compte') }}
        </h2>
        <p class="text-muted">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <button class="btn btn-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Supprimer le compte') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
            @csrf
            @method('delete')

            <h2 class="h5 text-danger">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>
            <p class="text-muted">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer la suppression définitive de votre compte.') }}
            </p>

            <!-- Champ du mot de passe -->
            <div class="mt-4">
                <label for="password" class="form-label visually-hidden">{{ __('Mot de passe') }}</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required>
                
                @if ($errors->userDeletion->has('password'))
                    <div class="text-danger small mt-2">{{ $errors->userDeletion->first('password') }}</div>
                @endif
            </div>

            <!-- Boutons de confirmation -->
            <div class="mt-4 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </button>
                <button type="submit" class="btn btn-danger">
                    {{ __('Supprimer le compte') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
