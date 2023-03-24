@extends('layouts.web')

@section('title', 'Privacidade')

@section('content')
    
    <div class="container-xxl min-vh-100 py-5">
        <h1>Privacidade</h1>
        
        {!! config('web.privacy_term') !!}


    </div>

@endsection