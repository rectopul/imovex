@extends('layouts.web')

@section('title', 'Imovél')

@section('content')

	<property-image-carousel :images="{{ json_encode($property->images) }}"></property-image-carousel>

	<property-details-template :property="{{ json_encode($property) }}"></property-details-template>

    <property-card-list
        url="{{ route('web.home.property.index') }}"
        title="Imóveis Relacionados"
        simple
    ></property-card-list>

	<property-card-list 
        title="Histórico de Navegação" 
        simple
        url="{{ route('web.history.visitor', $visitor) }}"
    ></property-card-list>

@endsection

@push('js')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60de346aa9d1b5b5"></script>
@endpush