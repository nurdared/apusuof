<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'APUSUOF') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forum.css') }}" rel="stylesheet">

    


</head>

<body>
    @include('inc.navbar')
    <div style="
                                        height:auto !important;
                                        min-height:80%;">
        @yield('welcome')
        <div class="container">
            @include('inc.messages') 
            @yield('content')
    
            {{-- Profile View --}}
            <div class="row">
                <div class="col-md-5">
                    @yield('profile') 
                </div>
                <div class="col-md-7">
                    @yield('profilecontent') 
                </div>
            </div>

        </div>

        
    </div>
    
    
    
    <!-- Scripts -->
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
        CKEDITOR.replace( 'article-ckeditor2' );
    </script>
        <script>
        CKEDITOR.replace( 'article-ckeditorEC', { height: 100 } );
    </script>
    
    {{-- <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script> --}}
    
    @yield('js')
    
</body>
@include('inc.footer')
</html>