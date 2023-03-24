@extends('layouts.web')

@section('title', 'Catalogo')

@section('content')
    
    <property-card-list-infinite
        url="{{ route('web.catalog.property.index', request()->all()) }}"
        :records=15
        :user-filters="{{ json_encode(request()->all()) }}"
    >
    </property-card-list-infinite>

    <property-card-list 
        title="Histórico de Navegação" 
        simple
        url="{{ route('web.history.visitor', $visitor) }}"
        :records=5
    ></property-card-list>

@endsection
