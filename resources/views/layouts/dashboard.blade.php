<!DOCTYPE html>
<html lang="en">
    
    <head>
        <base href="{{ URL::to('/') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        @hasSection('pageTitle')
            <title>Painel Imovél Explorer - @yield('pageTitle')</title>
        @else
            <title>Painel Imovél Explorer</title>
        @endif
        
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        @stack('css')
        
        <script src="{{ asset('js/dashboard.js') }}" defer></script>
        @stack('js')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">
        <div id="app">
            
            <navbar logo="{{ asset('img/'.config('web.logo_primary')) }}"></navbar>

            <div id="layoutSidenav">
                
                <sidebar :user="{{ Auth::user() }}" new-messages="{{ $newMessages }}"></sidebar>

                <div id="layoutSidenav_content" class="bg-light">
                    
                    <main>

                        <div class="container-fluid px-4">
                            
                            {{-- <ol class="breadcrumb mt-4">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                            <h1 class="h3 my-4 text-muted">@yield('title')</h1> --}}
                            @yield('title')

                            @if(session()->has('alert'))
                                <alert :flash="{{ json_encode(session()->get('alert')) }}"></alert>
                            @else
                                <alert></alert>
                            @endif

                            
                            @yield('content')
                            
                        </div>
                    </main>

                    <bottom></bottom>

                </div>
            </div>
        </div>
        
    </body>
</html>
