@extends('layouts.dashboard')

@section('pageTitle', 'Privacidade')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
@endpush

@section('title')
    
    <div class="row my-4">
        <div class="col-md-12">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-check"></i>
                Termo de Privacidade
            </h1>
        </div>
    </div>

@endsection

@section('content')
    
    <div class="card">
        <div class="card-body shadow-sm">

            <privacy-form privacy="{{ $privacy }}"></privacy-form>
        </div>
    </div>
    
@endsection