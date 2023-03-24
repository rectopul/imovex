@extends('layouts.web')

@section('title', 'Home')

@section('content')
    
    <home-hero
        title="{{ config('web.home_title') }}"
        sub-title="{{ config('web.home_subtitle') }}"
        url={{ route('web.catalog.index') }}
    >
    </home-hero>

    <home-vectors></home-vectors>
    
    <property-card-list 
        title="As melhores oportunidades" 
        bg 
        catalog
        url="{{ route('web.home.property.index') }}"
        :records=5
    ></property-card-list>
    
    <div class="container-xxl">
        <post-card-list 
            title="Notícias e novidades do mundo imobiliário"
            url="{{ route('web.home.post.index') }}" 
            :records=9
        ></post-card-list>
    </div>

    @if(session()->has('history'))
        <property-card-list 
            title="Histórico de Navegação" 
            simple
            url="{{ route('web.history.visitor', $visitor) }}"
            :records=5
        ></property-card-list>
    @endif

@endsection
