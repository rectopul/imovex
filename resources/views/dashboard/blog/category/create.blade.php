@extends('layouts.dashboard')

@section('pageTitle', isset($category) ? 'Editar Categoria' : 'Nova Categoria')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-12">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-tag"></i>
                {{ isset($category) ? 'Editar Categoria' : 'Nova Categoria' }}
            </h1>
        </div>
    </div>

@endsection

@section('content')
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @isset($category)
                        <category-form :edit="{{ $category }}"></category-form>
                    @else
                        <category-form></category-form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    
@endsection