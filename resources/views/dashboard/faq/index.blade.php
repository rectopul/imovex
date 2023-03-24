@extends('layouts.dashboard')

@section('pageTitle', 'Dicionário')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-6">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-question-circle"></i>
                Dicionário
            </h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('dashboard.faq.create') }}" class="btn btn-success">
                <i class="fa fa-fw fa-plus-circle"></i>
                Novo
            </a>
        </div>
    </div>

@endsection

@section('content')

    <faq-table-tools></faq-table-tools>

    <div class="row">
        <div class="col">
            <faq-table />
        </div>
    </div>

    <remove-modal id="remove-faq-modal">
        <p class="m-0">Deseja realmente remover o Faq?</p>
        <small class="text-muted">* Essa operação não poderá ser desfeita</small>
    </remove-modal>
  
@endsection