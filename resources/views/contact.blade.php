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
    <section id="help" class="py-5"
        style="background: linear-gradient(270deg, #1A242F 0.01%, rgba(26, 36, 47, 0.00) 100%);">
        <div class="container-lg my-5">
            <div class="row d-flex justify-content-between align-items-center">

                <div class="col-md-6">
                    <div class="image-holder d-flex">
                        <img src="{{ asset('assets/images/group.png') }}" class="img-fluid"
                            alt="Aide pour trouver un logement" loading="lazy">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="text-content ps-md-5 mt-4 mt-md-0">
                        <form action="{{ route('post.contact') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fs-6 text-uppercase fw-bold text-white">Nom et
                                    Prénom</label>
                                <input type="text" id="name" name="name" placeholder="Nom et Prénom"
                                    class="form-control ps-3" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail3"
                                    class="form-label fs-6 text-uppercase fw-bold text-white">Adresse
                                    email</label>
                                <input type="email" id="exampleInputEmail3" name="email" placeholder="Email"
                                    class="form-control ps-3" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label fs-6 text-uppercase fw-bold text-white">Votre
                                    message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required>
                            
                        </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer le message</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection
