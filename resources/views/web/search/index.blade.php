@extends('layouts.web')

@section('title', 'Busca')

@section('content')
    
    <div class="container-xxl min-vh-100 pb-5">
        
        <h1 class="mt-5 fw-bold">Resultados para busca por <i>"{{ request()->get('q') }}"</i></h1>

        <search-form></search-form>

        <property-search-results
			url="{{ route('web.search.property.index', ['search' => request()->get('q')]) }}"
			:records=10
		>
		</property-search-results>
        
        <post-search-results
            url="{{ route('web.search.post.index', ['search' => request()->get('q')]) }}" 
            :records=8
        >
        </post-search-results>

        <faq-search-results
            url="{{ route('web.search.faq.index', ['search' => request()->get('q')]) }}"
            :records=6
        >
        </faq-search-results>

    </div>

@endsection