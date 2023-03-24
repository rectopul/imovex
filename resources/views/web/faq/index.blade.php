@extends('layouts.web')

@section('title', 'Dicionário')

@section('content')
	
	<faq-template>
        
        @isset($faq->title)
            {{-- <faq-header only-header></faq-header>
            <faq-breadcrumbs 
                :faq-item="{{ $faq }}"
                share-links="{{ $shareComponent }}"
            ></faq-breadcrumbs> --}}

            <faq-description :faq-item="{{ $faq }}"></faq-description>
            <faq-pagination url="{{ route('web.faq.index') }}" :faq-item="{{ $faq }}"></faq-pagination>
        @else
            <faq-header></faq-header>

            @if($mostViewedFaq)
                <faq-highlight :faq="{{ $mostViewedFaq }}"></faq-highlight>
            @endif

            @if(request()->route('index'))
                <faq-pagination 
                    url="{{ route('web.faq.index') }}"
                    faq-index="{{ request()->route('index') }}"
                ></faq-pagination>
            @else
                <faq-pagination
                    url="{{ route('web.faq.index') }}"
                ></faq-pagination>
            @endif

        @endisset



	</faq-template>

@endsection

@push('js')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60de346aa9d1b5b5"></script>
@endpush