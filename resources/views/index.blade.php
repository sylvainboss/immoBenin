@extends('user-layout')
@section('content')
    <!-- billboard start  -->
    <section id="billboard">
        <div class="container ">
            <div class="row flex-lg-row-reverse align-items-center ">

                <div class="col-lg-6">
                    <img src="{{ asset('assets/images/billboard.png') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>

                <div class="col-lg-6">
                    <h2 class="text-capitalize lh-1 my-3">La meilleure solution pour acheter, louer ou vendre un bien
                        immobilier</h2>
                    <p class="lead">Que vous cherchiez à acquérir votre résidence de rêve, un appartement moderne ou
                        un terrain pour vos projets, nous vous accompagnons à chaque étape. Profitez d’une expérience
                        simple, rapide et sécurisée avec des options de financement flexibles et un accompagnement
                        personnalisé.</p>
                    @include('components.search-component')
                </div>
            </div>
        </div>
    </section>

    <!-- Feature start  -->
    <section id="feature">
        <div class="container py-5">
            <div class="row">
                <div class="section-header align-center mb-5">
                    <h2 class=" text-capitalize m-0">Mis en avant dans</h2>
                </div>
            </div>
            <div class="row d-flex justify-content-between">
                <div class="col-md-2 ">
                    <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;"><img
                            alt="image" src="{{ asset('assets/images/logo1.png') }}"></div>
                </div>
                <div class="col-md-2">
                    <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;"><img
                            alt="image" src="{{ asset('assets/images/logo2.png') }}"></div>
                </div>
                <div class="col-md-2">
                    <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;"><img
                            alt="image" src="{{ asset('assets/images/logo3.png') }}"></div>
                </div>
                <div class="col-md-2">
                    <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;">
                        <img alt="image" src="{{ asset('assets/images/logo4.png') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;">
                        <img alt="image" src="{{ asset('assets/images/logo6.png') }}">
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- Residence start  -->
    <section id="residence">
        @include('components.popular-properties')
    </section>

    <!--About us start  -->
    @include('components.about-component')
    <!-- Testimonial start  -->
    <section id="testimonial">
        <div class="container my-5">
            <div class="swiper testimonial-swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="row my-5 py-lg-5">
                            <div class="col-md-8 mx-auto">
                                <img src="{{ asset('assets/images/quote.png') }}" class="rounded mx-auto d-inline"
                                    alt="Citation">
                                <p class="testimonial-p mt-4">Un service impeccable qui rend le processus d’achat et de
                                    location simple et agréable. La plateforme est intuitive et l’équipe est très
                                    réactive. Merci !</p>

                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="pt-5 mb-1">Elena Pravo</p>
                                        <p class="">Directrice Générale, Upstate</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="row my-5 py-lg-5">
                            <div class="col-md-8 mx-auto">
                                <img src="{{ asset('assets/images/quote.png') }}" class="rounded mx-auto d-inline"
                                    alt="Citation">
                                <p class="testimonial-p mt-4">J’ai trouvé la maison idéale en un rien de temps ! Le
                                    site propose des options variées et adaptées à tous les budgets, avec des
                                    informations claires et fiables.</p>

                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="pt-5 mb-1">Louis Dupont</p>
                                        <p class="">Acheteur, ImmoReel</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="row my-5 py-lg-5">
                            <div class="col-md-8 mx-auto">
                                <img src="{{ asset('assets/images/quote.png') }}" class="rounded mx-auto d-inline"
                                    alt="Citation">
                                <p class="testimonial-p mt-4">Une expérience rapide et professionnelle. Les
                                    transactions se font sans effort et en toute transparence. Je recommande vivement
                                    cette plateforme !</p>

                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="pt-5 mb-1">Sophie Martin</p>
                                        <p class="">Propriétaire, Investimo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="testimonial-swiper-button col-md-3 position-absolute">
                    <div class="swiper-button-prev testimonial-arrow"></div>
                    <div class="arrow-divider"> | </div>
                    <div class="swiper-button-next testimonial-arrow"></div>
                </div>

            </div>
        </div>

    </section>

    <!-- Help start  -->
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
                        <h2 class="text-capitalize">Nous aidons les gens à trouver un logement</h2>
                        <p>Nous facilitons la recherche de biens immobiliers adaptés à vos besoins. Que vous souhaitiez
                            acheter, louer, ou investir, notre plateforme vous guide à chaque étape. Profitez d'une
                            recherche fluide et de conseils personnalisés pour trouver le logement idéal en toute
                            confiance.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Nous contacter</a>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <!-- Lets start  -->
    <section id="start">
        <div class="container my-5 py-5">
            <div class="row featurette py-lg-5">
                <div class="col-md-5 order-md-1 d-flex">
                    <h1 class="text-capitalize lh-1 mb-3">Commencez simplement avec ImmoBénin</h1>
                </div>
                <div class="col-md-7 order-md-2">
                    <div class="text-content ps-md-5 mt-4 mt-md-0">
                        <p class="py-lg-2">Rejoignez notre plateforme et publiez facilement vos annonces de biens
                            immobiliers. Que vous souhaitiez louer, vendre ou faire connaître votre propriété, Rentiz vous
                            offre une visibilité optimale et une gestion simplifiée.</p>
                        <a href="{{ route('profile') }}" class="btn btn-primary btn-lg px-4 me-md-2">Commencez</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
