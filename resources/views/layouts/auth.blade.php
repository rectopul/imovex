<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name') }} - Painel</title>

        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        
        <script src="{{ asset('js/dashboard.js') }}" defer></script>

        <style>
            body {
                background: rgb(39,59,146);
                background: linear-gradient(90deg, rgba(39,59,146,1) 0%, rgba(189,51,117,1) 50%, rgba(228,118,57,1) 100%);
            }
        </style>

    </head>

    <body>
        
        <div id="app">
            <div class="container-xxl">
                @yield('content')
            </div>
        </div>

    </body>

</html>