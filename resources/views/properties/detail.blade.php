@extends('user-layout')

@section('content')
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
    <div class="container my-5 py-5">
        <div class="row">
            <!-- Carousel des images de l'annonce -->
            <div class="col-md-8">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($property->images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->url) }}" class="d-block w-100" alt="image"
                                    style="height: 500px">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Détails de l'annonce -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->nom }}</h5>
                        <p class="card-text"><strong>Adresse:</strong> {{ $property->adresse }}</p>
                        <p class="card-text"><strong>Ville:</strong> {{ $property->ville->nom }}</p>
                        <p class="card-text"><strong>Type:</strong> {{ $property->type->type }}</p>
                        <p class="card-text"><strong>Superficie:</strong> {{ $property->superficie }} m²</p>
                        @if ($property->nombre_piece > 0)
                            <p class="card-text"><strong>Nombre de pièces:</strong> {{ $property->nombre_piece }}</p>
                        @endif
                        <h4 class="text-success mt-3">Prix: {{ number_format($property->prix, 0, ',', ' ') }} CFA</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire de contact -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Contactez le propriétaire</h5>
                        <form action="{{route('property.contact',$property->userid)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label">Votre message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required>
                                    
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer le message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
