@extends('layouts.dashboard')

@section('pageTitle', 'Comentários')

@section('title')
    <div class="row my-4">
        <div class="col-md-6">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-comments"></i>
                Comentários
            </h1>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col">
            <comment-table-toolbar />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <comment-table />
        </div>
    </div>

    <remove-modal id="remove-modal">
        <p class="m-0">Deseja realmente remover o comentário?</p>
        <small class="text-muted">* Essa operação não poderá ser desfeita</small>
    </remove-modal>

@endsection