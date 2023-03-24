@extends('layouts.dashboard')

@section('pageTitle', 'Mensagem')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-6">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-envelope"></i>
                Mensagem
            </h1>
        </div>
        <div class="col-md-6 text-end">
            
        </div>
    </div>

@endsection

@section('content')
    
    <div class="row mb-2">
        <div class="col text-end">
            <a href="{{ route('dashboard.contact.destroy', $contact) }}" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#remove-modal">
                <i class="fa fa-fw fa-trash"></i> Excluir
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p class="fw-bold h4">{{ $contact->subject }}</p>
                            <p class="m-0">{{ $contact->name }}</p>
                            <p class="m-0 text-muted small">{{ $contact->email }}</p>
                            <p class="m-0 text-muted small">{{ $contact->phone }}</p>
                        </div>
                        <div class="col-auto text-end small">
                            {{ $contact->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
    
                    <p class="mt-4">
                        {{ $contact->message }}
                    </p>
    
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('dashboard.contact.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fa fa-fw fa-arrow-left"></i>
                                Voltar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <remove-modal redirect="{{ route('dashboard.contact.index') }}">
        <p class="m-0">Deseja realmente remover a mensagem?</p>
        <small class="text-muted">* Essa operação não poderá ser desfeita</small>
    </remove-modal>


@endsection