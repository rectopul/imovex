@extends('layouts.dashboard')

@section('pageTitle', $faq->title ?? 'Novo Dicionário')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
@endpush

@section('title')
    
    <div class="row my-4">
        <div class="col-md-12">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-question-circle"></i>
                {{ $faq->title ?? 'Novo Dicionário' }}
            </h1>
        </div>
    </div>

@endsection

@section('content')
    
    <faq-form @isset($faq) :edit="{{ $faq }}" @endisset></faq-form>
    
@endsection