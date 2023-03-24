@extends('layouts.dashboard')

@section('pageTitle', 'Mensagens')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-6">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-envelope"></i>
                Mensagens
            </h1>
        </div>
        <div class="col-md-6 text-end">
            
        </div>
    </div>

@endsection

@section('content')

    <div class="row">
        <div class="col">
            <contact-table-toolbar />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <contact-table />
                </div>
            </div>
        </div>
    </div>

    <remove-modal id="remove-modal">
        <p class="m-0">Deseja realmente remover a mensagem?</p>
        <small class="text-muted">* Essa operação não poderá ser desfeita</small>
    </remove-modal>
  
  
@endsection