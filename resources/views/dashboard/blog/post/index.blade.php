@extends('layouts.dashboard')

@section('pageTitle', 'Artigos')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-6">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-thumbtack"></i>
                Artigos
            </h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('dashboard.blog.post.create') }}" class="btn btn-success">
                <i class="fa fa-fw fa-plus-circle"></i>
                Novo Post
            </a>
        </div>
    </div>

@endsection

@section('content')

    <div class="row">
        <div class="col">
            <post-table-toolbar />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <post-table />
        </div>
    </div>

    <remove-modal id="remove-modal">
        <p class="m-0">Deseja realmente remover o Post?</p>
        <small class="text-muted">* Essa operação não poderá ser desfeita</small>
    </remove-modal>

@endsection