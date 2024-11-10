@extends('admin-layout')

@section('admin')
    <div class="container">
        <div class="grid mt-4">
            @forelse ($contacts as $contact)
                <div class="col-md-3">
                    <div class=" card p-2">
                        <div class="card-head flex">
                            <h3>{{ $contact->name }}</h3>
                            <p>envoyé le {{ $contact->created_at }}</p>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $contact->message }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">
                    aucun message
                </div>
            @endforelse
        </div>
    </div>
@endsection
