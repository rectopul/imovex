@extends('layouts.dashboard')

@section('pageTitle', $post->title ?? 'Novo Post')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-12">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-thumbtack"></i>
                {{ $post->title ?? 'Novo Post' }}
            </h1>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
@endpush

@section('content')
    
    @isset($post)
        <post-form :edit="{{ $post }}"></post-form>
    @else
        <post-form></post-form>
    @endisset
    
@endsection