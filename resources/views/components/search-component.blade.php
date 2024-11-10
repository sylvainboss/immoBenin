<nav class="navbar navbar-expand-lg billboard-nav">
    <div class="container billboard-search p-0">
        <form action="{{ route('search-property') }}" method="GET">
            <div class="row billboard-row">
                <div class="col-lg-2 billboard-select">
                    <select class="form-select mb-2 mb-lg-0" name="search_type" aria-label="Purpose">
                        <option value="Vente">Vente</option>
                        <option value="Location">Location</option>
                    </select>
                </div>
                <div class="col-lg-2 billboard-select">
                    <select class="form-select mb-2 mb-lg-0" name="location" aria-label="Location">
                        <option>Localisation</option>
                        @foreach ($villes as $ville)
                            <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 billboard-select">
                    <select class="form-select mb-2 mb-lg-0" name="type" aria-label="Type">
                        <option>Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 ">
                    <label for="prix_min">Prix min</label>
                    <input type="number" name="prix_min" class="form-control mb-2 mb-lg-0 border-0" placeholder="Prix minimum">
                </div>
                <div class="col-lg-2 ">
                    <label for="prix_max">Prix max</label>
                    <input type="number" name="prix_max" class="form-control mb-2 mb-lg-0 border-0" placeholder="Prix maximum">
                </div>
                <div class="col-lg-2 billboard-btn">
                    <button type="submit" class="btn btn-primary btn-lg billboard-search">Valider</button>
                </div>
            </div>
        </form>
    </div>
</nav>
