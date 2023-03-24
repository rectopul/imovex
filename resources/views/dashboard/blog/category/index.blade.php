@extends('layouts.dashboard')

@section('pageTitle', 'Categorias')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-6">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-tag"></i>
                Categorias
            </h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('dashboard.blog.category.create') }}" class="btn btn-success">
                Nova Categoria
            </a>
        </div>
    </div>

@endsection

@section('content')

    <div class="row">
        <div class="col">
            <category-table-toolbar />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <category-table />
        </div>
    </div>

    <remove-modal id="remove-modal">
        <p class="m-0">Deseja realmente remover a Categoria?</p>
        <small class="text-muted">* Todos os posts relacionados serão removidos</small>
    </remove-modal>
  
@endsection