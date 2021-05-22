<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Minify.Az - Pulsuz elanlar | Alqı-satqı</title>
    <meta name="description" content="Pulsuz Elanlar, Alqı-satqı, Elektronika, Geyim, Şəxsi əşyalar, Xidmətlər, Uşaqlar üçün, Oyuncaqlar, Heyvanlar, Nəqliyyat">
    <meta name="robots" content="index, follow">
    
    <meta property="og:title" content="{{ config('app.name', 'Minify') }}" />
    <meta property="og:description" content="Pulsuz Elanlar, Alqı-satqı, Elektronika, Geyim, Şəxsi əşyalar, Xidmətlər, Uşaqlar üçün, Oyuncaqlar, Heyvanlar, Nəqliyyat" />
    <meta property="og:image" content="{{asset('storage/images/logo2.png')}}" />
    <meta property="og:type" content="article" />
    
    <link rel="icon" type="image/png" href="{{asset('storage/images/Mini.png')}}">
    {{-- <link rel="icon" type="image/png" href="/favicon-16x16.png"> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
    <link href="{{asset('css/fontawesome.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- <link rel = "stylesheet" href = "https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">     --}}
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    Minify
                    {{-- <span style="font-size: 22px; font-family: Poppins; font-weight: 600">mini<span style="margin-left: 2px;padding: 5px 8px; background: #222; color: #fff; border-radius: 6px">fy</span></span> --}}
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Mağazalar</a></li>
                    <li class="active"><a href="#">Kateqoriyalar</a></li>
                </ul>
                <form class="navbar-form navbar-left" action="/axtar" role="search">
                    <div class="form-group form-search">
                        <input id="axtar" type="text" name="axtar" class="form-control col-md-6" value="{{old('axtar')}}" placeholder="Əşya və ya xidmət axtarın...">
                        <div class="icon"><i class="feather-search" style="font-size: 15px"></i></div>
                    </div>
                    <button type="submit" class="btn btn-search">Axtarış et</button>
                </form>
                <ul class="nav navbar-nav navbar-right xs-p-3">
                    <li><a class="btn-sel" href="/sell"><i class="fas fa-paper-plane"></i> Elan yerləşdir</a></li>
                    @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}} {{Auth::user()->surname}}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Şəxsi kabinet</a></li>
                            <li><a href="#">Balans</a></li>
                            <li class="divider"></li>
                            {{-- <form action="/logout" method="post"> --}}
                                {{-- @csrf --}}
                                <li><a href="{{url('logout')}}">Təhlükəsiz çıxış</a></li>
                            {{-- </form> --}}
                        </ul>
                    </li>
                    @else
                    <li class="sign">
                        <li><a href="/login">Daxil ol</a></li>
                        <li><a href="/register">Qeydiyyat</a></li>
                    </li>
                    @endauth
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

    <div class="header navbar navbar-fixed-top">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle navbar-toggle-black collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="/c/elektronika">Elektronika</a></li>
                    <li><a href="/c/geyim">Geyim</a></li>
                    <li><a href="/c/shexsi-esyalar">Şəxsi əşyalar</a></li>
                    <li><a href="/c/xidmetler">Xidmətlər</a></li>
                    <li><a href="/c/usaq">Uşaq</a></li>
                    <li><a href="/c/hobbi-ve-asude">Hobbi və asudə</a></li>
                    <li><a href="/c/usaq-alemi">Uşaq aləmi</a></li>
                    <li><a href="/c/heyvanlar">Heyvanlar</a></li>
                    <li><a href="/c/neqliyyat">Nəqliyyat</a></li>
                </ul>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer>
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
    </footer>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/swipe.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

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