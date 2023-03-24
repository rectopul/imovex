@extends('layouts.dashboard')

@section('pageTitle', 'Usuários')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-6">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-user"></i>
                Usuários
            </h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('dashboard.user.create') }}" class="btn btn-success">
                Novo Usuário
            </a>
        </div>
    </div>

@endsection

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <user-table></user-table>
                </div>
            </div>
        </div>
    </div>

    <remove-modal id="remove-user-modal">
        <p class="m-0">Deseja realmente remover o Usuário?</p>
        <small class="text-muted">* Essa operação não poderá ser desfeita</small>
    </remove-modal>

@endsection