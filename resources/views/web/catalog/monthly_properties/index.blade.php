@extends('layouts.web')

@section('title', 'Imóveis do Mês')

@section('content')
    
    <property-card-list
        title="Imóveis do Mês"
        url="{{ route('web.catalog.monthly_properties.index', request()->all()) }}"
        :records=15
        :user-filters="{{ json_encode(request()->all()) }}"
    >
    </property-card-list>

    <property-card-list 
        title="Histórico de Navegação" 
        simple
        url="{{ route('web.history.visitor', $visitor) }}"
        :records=5
    ></property-card-list>

@endsection
