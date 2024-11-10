@extends('user-layout')

@section('content')
    <div class="container" style="margin-left: auto; margin-top:100px;margin-bottom:50px">
        <div class=" col-md-6 mt-4" style="background: white">
            @include('components.register-component')
        </div>
    </div>
@endsection
