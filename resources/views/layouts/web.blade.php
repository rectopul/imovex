<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{URL::to('/')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
    <title>{{ config('app.name') }} - @yield('title')</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <script src="{{ asset('js/web.js') }}" defer></script>

    <link href="{{ asset('css/web.css') }}" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    @stack('css')

    <style>
        .container-xxl {
            width: 98.958vw !important;
        }
    </style>
</head>
<body>
    
    <div id="app">
        
        <navbar 
            primary-logo="{{ config('web.logo_primary') ? asset('img/'.config('web.logo_primary')) : '' }}"
            secondary-logo="{{ config('web.logo_secondary') ? asset('img/'.config('web.logo_secondary')) : '' }}"
        >
        </navbar>

        <main>
            @yield('content')
        </main>
        
        <bottom
            logo="{{ config('web.logo_secondary') ? asset('img/'.config('web.logo_secondary')) : '' }}"
            whatsapp="{{ config('web.social_whatsapp') }}"
            facebook="{{ config('web.social_facebook') }}"
            instagram="{{ config('web.social_instagram') }}"
            youtube="{{ config('web.social_youtube') }}"
            company="{{ config('web.company_name') }}"
            cnpj="{{ config('web.company_cnpj') }}"
            site="{{ config('web.company_site') }}"
            address="{{ config('web.company_address') }}"
        >
        </bottom>

    </div>

    @stack('js')
    {{-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60de346aa9d1b5b5"></script> --}}
</body>
</html>
