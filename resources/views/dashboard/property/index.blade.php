@extends('layouts.dashboard')

@section('pageTitle', 'Imovéis')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-6">
            <h1 class="h3 text-muted">
            	<i class="fa fa-fw fa-building"></i>
            	Imóveis
            </h1>
        </div>
        <div class="col-md-6 text-end">
            
        </div>
    </div>

@endsection

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <property-table></property-table>
                </div>
            </div>
        </div>
    </div>

@endsection