<div class="container  my-5 py-5">
    <h2 class="text-capitalize m-0 py-lg-5">Les annonces populaires</h2>

    <div class="swiper-button-next residence-swiper-next  residence-arrow"></div>
    <div class="swiper-button-prev residence-swiper-prev residence-arrow"></div>

    <div class="swiper residence-swiper">
        <div class="swiper-wrapper">
            @forelse ($properties as $item)
                <div class="swiper-slide">
                    <div class="card">
                        <!-- Carousel des images de l'annonce -->
                        <div id="carousel-{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($item->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <a href="{{ route('property.xyz.show', $item->id) }}">
                                            <img src="{{ asset('storage/' . $image->url) }}" class="d-block w-100"
                                                alt="image" style="height: 280px; object-fit:cover">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <a href="index.html">
                                <h5 class="card-title pt-4">{{ $item->nom }}</h5>
                            </a>
                            <p class="card-text">{{ $item->adresse }}</p>

                            <div class="card-text">
                                <ul class="d-flex">
                                    @if ($item->nombre_piece > 0)
                                        <li class="residence-list"> <img src="{{ asset('assets/images/bed.png') }}"
                                                alt="image">{{ $item->nombre_piece }} Chambres</li>
                                    @endif
                                    <li class="residence-list"> <img src="{{ asset('assets/images/square.png') }}"
                                            alt="image">{{ $item->superficie }} m²</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="danger">
                    aucune annonce pour le moment
                </div>
            @endforelse
        </div>
    </div>
    <div class="residence-btn">
        <a href="{{ route('property.xyz.index') }}" class="btn btn-primary btn-lg my-5">Voir toutes les annonces</a>
    </div>
</div>
