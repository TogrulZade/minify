<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') Minify.Az - Pulsuz elanlar | Alqı-satqı</title>
    <meta name="description" content="Pulsuz Elanlar, Alqı-satqı, Elektronika, Geyim, Şəxsi əşyalar, Xidmətlər, Uşaqlar üçün, Oyuncaqlar, Heyvanlar, Nəqliyyat">
    <meta name="robots" content="index, follow">
    
    <meta property="og:title" content="Minify.Az - Pulsuz elanlar | Alqı-satqı" />
    <meta property="og:description" content="Pulsuz Elanlar, Alqı-satqı, Elektronika, Geyim, Şəxsi əşyalar, Xidmətlər, Uşaqlar üçün, Oyuncaqlar, Heyvanlar, Nəqliyyat" />
    <meta property="og:title" content="" />
    <meta property="og:image" content="{{Request()->segment(1) == 'product' ? asset('storage/'.$screen_image) : asset('storage/images/Minify-44.jpg')}}" />
    <meta property="og:type" content="article" />
    
    <link rel="icon" type="image/png" href="{{asset('storage/images/Mini.png')}}">
    {{-- <link rel="icon" type="image/png" href="/favicon-16x16.png"> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
    <link href="{{asset('css/fontawesome.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?r=') }}<?php echo rand(0,9999) ?>" rel="stylesheet">
    {{-- <link rel = "stylesheet" href = "https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">     --}}
    {{-- <script data-ad-client="ca-pub-4868026875595408" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}

</head>
<body>
    @if($agent->isMobile())
        @include('layouts.mobile.nav')    
    @else
        @include('layouts.web.nav')
        <a href='/sell' class="addItemButton">
            <span><i class="feather-plus" style="font-size: 20px;"></i></span>
        </a>
    @endif

    <main style="{{$agent->isMobile() ? 'margin-top: 0;' : 'background-color:#f8f9fd;'}} {{!Request::is('/') && !$agent->isMobile() ? 'margin-top: 60px;' : ''}}">
        @yield('content')
    </main>

    {{-- <footer>
        <div class="col-md-4">
            <ul>
                <li><a href="#">minify nədir?</a></li>
                <li><a href="#">İstifadəçi razılaşması</a></li>
                <li><a href="#">Saytda reklam</a></li>
                <li><div class="brand-s">&#169; minify.</div></li>
            </ul>
        </div>


        <div class="col-md-4">
            <ul>
                <li><a href="#">minify nədir?</a></li>
                <li><a href="#">İstifadəçi razılaşması</a></li>
                <li><a href="#">Saytda reklam</a></li>
            </ul>
        </div>


        <div class="col-md-4">
            <ul>
                <li><a href="#">minify nədir?</a></li>
                <li><a href="#">İstifadəçi razılaşması</a></li>
                <li><a href="#">Saytda reklam</a></li>
            </ul>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </footer> --}}
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/swipe.js') }}"></script>
    <script src="{{ asset('js/script.js?r=') }}<?php echo rand(0,99999)?>"></script>

    <script>
        // window.mySwipe = new Swipe(document.getElementById('slider'));
        window.mySwipe = new Swipe(document.getElementById('swipe'), {
            startSlide: 0,
            speed: 400,
            //   auto: 3000,
            draggable: true,
            continuous: true,
            disableScroll: false,
            stopPropagation: false,
            ignore: ".scroller",
            callback: function(index, elem, dir) {},
            transitionEnd: function(index, elem) {}
        });
    </script>
</html>