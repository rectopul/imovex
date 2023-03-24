@extends('layouts.dashboard')

@section('pageTitle', isset($user) ? 'Editar Usuário' : 'Novo Usuário')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-6">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-user"></i>
                {{ isset($user) ? 'Editar Usuário' : 'Novo Usuário' }}
            </h1>
        </div>
    </div>

@endsection

@section('content')
    
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @isset($user)
                        <user-form :user="{{ $user }}"></user-form>
                    @else
                        <user-form></user-form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    
@endsection